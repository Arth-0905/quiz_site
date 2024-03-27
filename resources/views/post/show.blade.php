<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight text-center">
            {{$post->title}}
        </h1>
        <h2 class="text-center">
            作成者：{{$post->user->name}}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-r from-purple-200 via-rose-100 to-purple-200 pt-12">
        <div class=" w-5/6 m-auto">
            <div class="bg-white w-full rounded-2xl">
                <div class="p-4 text-center">
                    <h1 class="py-2">
                        問題
                    </h1>

                    @if(!empty($post->path))
                    <img src="{{asset($post->path)}}">
                    @endif
                    
                    <p class="">
                        {{$post->question}}
                    </p>
                    <div class="question-wrap">
                        <form action="{{route('post.answer')}}" method="get">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $post->id }}">
                            <input type="hidden" name="release" value="{{ $post->release }}">
                            @foreach($post->choices as $index => $choice)
                                <div class="my-2 hover:text-gray-400 text-lg">
                                    <label>
                                        <input type="radio" name="choice" value="{{ $index }}" required>
                                        {{ $choice }}
                                    </label>
                                </div>
                            @endforeach
                            <x-primary-button class="mt-2 text-3xl hover:bg-purple-400 hover:text-black">
                                回答する
                            </x-primary-button>
                        </form>
                    </div>
                </div>

                <div class="flex">
                    @if ($previousQuestionId)
                    <p class="flex-1 p-2">
                        <a href="{{route('post.show', $previousQuestionId)}}" class="link hover:text-blue-500">
                            前の問題へ
                        </a>
                    </p>
                    @endif
                    @if ($nextQuestionId)
                    <p class="flex-2 text-right p-2">
                        <a href="{{route('post.show', $nextQuestionId)}}" class="link hover:text-blue-500">
                            次の問題へ
                        </a> 
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>