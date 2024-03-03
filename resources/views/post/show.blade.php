<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            問題
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white w-full rounded-2xl">
            <div class="mt-4 p-4">
                <h1 class="text-lg font-semibold">
                    {{$post->title}}
                </h1>

                <img src="{{ asset($post->path) }}">
                
                <p class="mt-4 whitespace-pre-line">
                    {{$post->question}}
                </p>

                <div class="question-wrap">
                    <form action="{{route('post.answer')}}" method="get">
                        @csrf
                        <input type="hidden" name="question_id" value="{{ $post->id }}">
                        @foreach($post->choices as $index => $choice)
                            <div>
                                <label>
                                    <input type="radio" name="choice" value="{{ $index }}" required>
                                    {{ $choice }}
                                </label>
                            </div>
                        @endforeach
                        <x-primary-button class="mt-2">
                            回答する
                        </x-primary-button>
                    </form>
                </div>

                <a href="{{route('post.index')}}" class="flex text-right mt-2">
                    <x-primary-button>
                        戻る
                    </x-primary-button>
                </a>

            </div>

            <div class="flex">
                @if ($previousQuestionId)
                <p class="flex-1">
                    <a href="{{route('post.show', $previousQuestionId)}}" class="link">
                        前の問題へ
                    </a>
                </p>
                @endif
                @if ($nextQuestionId)
                <p class="flex-2 text-right">
                    <a href="{{route('post.show', $nextQuestionId)}}" class="link">
                        次の問題へ
                    </a> 
                </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>