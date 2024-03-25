<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\wrong_question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function dashboard(User $user) {
        $user = User::where('id', auth()->id())->get();
        return view('dashboard', compact('user'));
    }
    public function create() {
        return view('post.create');
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'question' => 'required',
            'choices' => 'required',
            'correct_choice' => 'required',
        ]);

        $validated['user_id'] = auth() -> id();

        $validated['path'] = null;
        if($request->hasFile('image')){
        $dir = 'img';
        $file_name = $request->file('image')->getClientOriginalName();
        // 取得したファイル名で保存
        // storage/app/public/任意のディレクトリ名/
        $request->file('image')->storeAs('public/' . $dir, $file_name);
        $validated['path'] = 'storage/' . $dir . '/' . $file_name;
        }

        if($request->input('release')) {
            $validated['release'] = true;
        }else {
            $validated['release'] = false;
        }

        $post = Post::create($validated);
        return view('create_completed', compact('post'));
    }
    public function index(Request $request) {
        $search = Post::where('release', 0)->orderBy('created_at', 'desc');

        $keyword = $request->input('keyword');

        if(isset($keyword)) {
            $search
                ->where('release', 0)
                ->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('question', 'LIKE', "%{$keyword}%")
                ->where('release', 0)
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })->where('release', 0);
        }

        $str = Post::where('release', 0)->orderBy('created_at', 'desc')->select('question')->get();
        $count = Post::where('release', 0)->count('question');
        for($i = 0; $i < $count; $i++) {
            $string[$i]= Str::limit($str[$i]->question, 20, '...');
        }

        //dd($string);

        $posts = $search->paginate(12);

        //for($i=0; $i<$count; $i++) {
          //$posts[$i]->question = $string[$i];}
          
        // $posts = Post::all();
        // $posts=Post::orderBy('created_at', 'desc')->paginate(10);
        return view('post.index', compact('posts', 'keyword', 'count'));
    }
    public function show(Post $post) {
        $questionId = $post->id;
        $releaseCheck = $post->release;

        if($releaseCheck === 0) {
            $previousQuestionId = Post::where('id', '<', $questionId)->where('release', 0)->orderBy('id', 'desc')->first();
            $nextQuestionId = Post::where('id', '>', $questionId)->where('release', 0)->first();
        }else {
            $previousQuestionId = Post::where('user_id', auth()->id())->where('id', '<', $questionId)->where('release', 1)->orderBy('id', 'desc')->first();
            $nextQuestionId = Post::where('user_id', auth()->id())->where('id', '>', $questionId)->where('release', 1)->first();
        }
        return view('post.show', compact('post', 'previousQuestionId', 'nextQuestionId'));
    }
    public function answer(Request $request) {
        $userAnswer = $request->input('choice');
        $questionId = $request->input('question_id');
        $question = Post::findOrFail($questionId);
        $correctChoiceIndex = $question->correct_choice - 1;
        $wrong = wrong_question::where('user_id', auth()->id())->where('post_id', '=', $questionId)->first();
        
        if ($userAnswer == $correctChoiceIndex) {
            $isCorrect = true;
            if($wrong===null) {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = false;
                $wrongQuestion = wrong_question::create($W);
            }else {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = false;
                $wrong->update($W);
            }
        } else {
            $isCorrect = false;
            if($wrong===null) {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = true;
                $wrongQuestion = wrong_question::create($W);
            }else {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = true;
                $wrong->update($W);
            }      
        }

        $releaseCheck = $request->input('release');
        if($releaseCheck == 0) {
            $previousQuestionId = Post::where('id', '<', $questionId)->where('release', 0)->orderBy('id', 'desc')->first();
            $nextQuestionId = Post::where('id', '>', $questionId)->where('release', 0)->first();
        }else {
            $previousQuestionId = Post::where('user_id', auth()->id())->where('id', '<', $questionId)->where('release', 1)->orderBy('id', 'desc')->first();
            $nextQuestionId = Post::where('user_id', auth()->id())->where('id', '>', $questionId)->where('release', 1)->first();
        }

        return view('post.answer', compact('isCorrect', 'question', 'userAnswer', 'nextQuestionId', 'previousQuestionId'));
    }
    public function self(Request $request) {
        $search = Post::where('user_id', auth()->id())->orderBy('created_at', 'desc');

        $keyword = $request->input('keyword');

        if(isset($keyword)) {
            $search->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('question', 'LIKE', "%{$keyword}%")
                ->where('user_id', auth()->id());
        }

        $posts = $search->paginate(10);

        return view('self', compact('posts', 'keyword'));
    }
    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }
    public function update(Request $request, Post $post) {
        $validated = $request->validate([
            'title' => 'required',
            'question' => 'required',
            'choices' => 'required',
            'correct_choice' => 'required'
        ]);

        $validated['user_id'] = auth() -> id();

        $validated['path'] = null;
        if($request->hasFile('image')){
        $dir = 'img';
        $file_name = $request->file('image')->getClientOriginalName();
        // 取得したファイル名で保存
        // storage/app/public/任意のディレクトリ名/
        $request->file('image')->storeAs('public/' . $dir, $file_name);
        $validated['path'] = 'storage/' . $dir . '/' . $file_name;
        }

        if($request->input('release')) {
            $validated['release'] = true;
        }else {
            $validated['release'] = false;
        }

        $post->update($validated);
        return view('update_completed', compact('post'));
    }
    public function destroy(Request $request, Post $post) {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('self');
    }
    public function explanation() {
        return view('explanation');
    }
    public function wrong(Request $request, Post $post) {
        $search = Post::whereHas('wrong_question', function($query){
            $query->where('user_id', auth()->id())
                    ->where('check', '=', 1);
        })->orderBy('updated_at', 'desc');

        $keyword = $request->input('keyword');

        if(isset($keyword)) {
            $search->where('title', 'LIKE', "%{$keyword}%")
                ->whereHas('wrong_question', function($query){
                    $query->where('user_id', auth()->id())
                            ->where('check', '=', 1);})
                ->orWhere('question', 'LIKE', "%{$keyword}%")
                ->whereHas('wrong_question', function($query){
                    $query->where('user_id', auth()->id())
                            ->where('check', '=', 1);})
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })->whereHas('wrong_question', function($query){
                    $query->where('user_id', auth()->id())
                            ->where('check', '=', 1);});
        }

        $posts = $search->paginate(12);

        return view('wrong_index', compact('posts', 'keyword'));
    }

    public function private(Request $request) {
        $search = Post::where('user_id', auth()->id())->where('release', 1)->orderBy('created_at', 'desc');

        $keyword = $request->input('keyword');

        if(isset($keyword)) {
            $search
                ->where('user_id', auth()->id())
                ->where('title', 'LIKE', "%{$keyword}%")
                ->where('release', 1)
                ->orWhere('question', 'LIKE', "%{$keyword}%")
                ->where('user_id', auth()->id())
                ->where('release', 1);
        }

        $posts = $search->paginate(12);

        return view('private_index', compact('posts', 'keyword'));
    }

    public function selfPrivate(Request $request) {
        $search = Post::where('user_id', auth()->id())->where('release', 1)->orderBy('created_at', 'desc');

        $keyword = $request->input('keyword');

        if(isset($keyword)) {
            $search->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('question', 'LIKE', "%{$keyword}%")
                ->where('user_id', auth()->id())->where('release', 1);
        }

        $posts = $search->paginate(10);

        return view('private', compact('posts', 'keyword'));
    }

    public function public(Request $request) {
        $search = Post::where('user_id', auth()->id())->where('release', 0)->orderBy('created_at', 'desc');

        $keyword = $request->input('keyword');

        if(isset($keyword)) {
            $search->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('question', 'LIKE', "%{$keyword}%")
                ->where('user_id', auth()->id())->where('release', 0);
        }

        $posts = $search->paginate(10);

        return view('public', compact('posts', 'keyword'));
    }

    public function wrongShow(Post $post) {
        $questionId = $post->id;

        $previousQuestionId = Post::where('id', '<', $questionId)->whereHas('wrong_question', function($query){
            $query->where('user_id', auth()->id())->where('check', '=', 1);})->orderBy('id', 'desc')->first();
        $nextQuestionId = Post::where('id', '>', $questionId)->whereHas('wrong_question', function($query){
            $query->where('user_id', auth()->id())->where('check', '=', 1);})->first();

        return view('wrong_show', compact('post', 'previousQuestionId', 'nextQuestionId'));   
    }

    public function wrongAnswer(Request $request) {
        $userAnswer = $request->input('choice');
        $questionId = $request->input('question_id');
        $question = Post::findOrFail($questionId);
        $correctChoiceIndex = $question->correct_choice - 1;
        $wrong = wrong_question::where('user_id', auth()->id())->where('post_id', '=', $questionId)->first();
        
        if ($userAnswer == $correctChoiceIndex) {
            $isCorrect = true;
            if($wrong===null) {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = false;
                $wrongQuestion = wrong_question::create($W);
            }else {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = false;
                $wrong->update($W);
            }
        } else {
            $isCorrect = false;
            if($wrong===null) {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = true;
                $wrongQuestion = wrong_question::create($W);
            }else {
                $W['user_id'] = auth()->id();
                $W['post_id'] = $questionId;
                $W['check'] = true;
                $wrong->update($W);
            }      
        }

        $previousQuestionId = Post::where('id', '<', $questionId)->whereHas('wrong_question', function($query){
            $query->where('user_id', auth()->id())->where('check', '=', 1);})->orderBy('id', 'desc')->first();
        $nextQuestionId = Post::where('id', '>', $questionId)->whereHas('wrong_question', function($query){
            $query->where('user_id', auth()->id())->where('check', '=', 1);})->first();

        return view('wrong_answer', compact('isCorrect', 'question', 'userAnswer', 'nextQuestionId', 'previousQuestionId'));
    }

    public function onlyView(Post $post) {
        return view('onlyView', compact('post'));
    }
}