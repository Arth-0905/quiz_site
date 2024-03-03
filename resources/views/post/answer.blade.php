<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if ($isCorrect)
            <p>正解！</p>
        @else
            <p>不正解</p>
        @endif
        </h2>
    </x-slot>

    <div>

        <a href="{{url()->previous()}}">
            もう一度解く
        </a>

        <a href="{{route('dashboard')}}">
            プロフィール画面へ
        </a>

        @if ($previousQuestionId)
        <a href="{{route('post.show', $previousQuestionId)}}" class="link">前の問題へ</a>
        @endif
        @if ($nextQuestionId)
        <a href="{{ route('post.show', $nextQuestionId) }}" class="link">次の問題へ</a> 
        @endif

    </div>

</x-app-layout>