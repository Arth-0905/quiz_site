<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
            'correct_choice' => 'required'
        ]);

        $validated['user_id'] = auth() -> id();

        $dir = 'image';
        $file_name = $request->file('image')->getClientOriginalName();


        $post = Post::create($validated);
        return view('create_completed', compact('post'));
    }

    public function index(Request $request) {
        $search = Post::orderBy('created_at', 'desc');

        $keyword = $request->input('keyword');

        if(!empty($keyword)) {
            $search->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('question', 'LIKE', "%{$keyword}%");
        }

        $posts = $search->paginate(10);

        // $posts = Post::all();
        // $posts=Post::orderBy('created_at', 'desc')->paginate(10);
        return view('post.index', compact('posts', 'keyword'));
    }

    public function show(Post $post) {
        $questionId = $post->id;
        $previousQuestionId = Post::where('id', '<', $questionId)->orderBy('id', 'desc')->first();
        $nextQuestionId = Post::where('id', '>', $questionId)->first();
        return view('post.show', compact('post', 'previousQuestionId', 'nextQuestionId'));
    }

    public function answer(Request $request)
    {
        $userAnswer = $request->input('choice');
        $questionId = $request->input('question_id');
        $question = Post::findOrFail($questionId);
        $correctChoiceIndex = $question->correct_choice - 1;

        if ($userAnswer == $correctChoiceIndex) {
            $isCorrect = true;
        } else {
            $isCorrect = false;
        }

        $previousQuestionId = Post::where('id', '<', $questionId)->orderBy('id', 'desc')->first();
        $nextQuestionId = Post::where('id', '>', $questionId)->first();

        return view('post.answer', compact('isCorrect', 'question', 'userAnswer', 'nextQuestionId', 'previousQuestionId'));
    }

    public function self(Request $request) {
        $search = Post::where('user_id', auth()->id())->orderBy('created_at', 'desc');

        $keyword = $request->input('keyword');

        if(!empty($keyword)) {
            $search->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('question', 'LIKE', "%{$keyword}%");
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



        $post->update($validated);
        return view('create_completed', compact('post'));
    }

    public function destroy(Request $request, Post $post) {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('self');
    }

    public function explanation() {
        return view('explanation');
    }
}
