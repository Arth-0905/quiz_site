<x-app-layout>
    <x-slot name="header">
        <h2 class="py-10 text-center text-9xl font-semibold text-gray-800 leading-tight">
        @if ($isCorrect)
            <span class="text-red-600">正解！</span>
        @else
            <span class="text-blue-600">不正解</span>
        @endif
        </h2>
        <div class="flex px-4">
            @if ($previousQuestionId)
            <p class="text-left flex-1">
            <a href="{{route('post.show', $previousQuestionId)}}" class="link hover:text-blue-500">前の問題へ</a>
            </p>
            @endif
            @if ($nextQuestionId)
            <p class="text-right flex-2">
            <a href="{{ route('post.show', $nextQuestionId) }}" class="link hover:text-blue-500">次の問題へ</a> 
            </p>
            @endif
        </div>
    </x-slot>

    <div class="w-full m-auto space-x-2 py-2 text-center bg-white">
        <a href="{{route('dashboard')}}">
            <x-primary-button class="bg-gradient-to-r from-gray-500 to-gray-100 w-5/12 h-48 hover:duration-300 hover:scale-105">
                メイン画面へ
            </x-primary-button>
        </a>
        <a href="{{url()->previous()}}">
            <x-primary-button class="bg-gradient-to-r from-red-500 to-orange-200 w-5/12 h-48 hover:duration-300 hover:scale-105">
                もう一度解く
            </x-primary-button>
        </a>
    </div>
    <div class="w-full m-auto space-x-2 py-2 text-center bg-white">
        <a href="{{route('post.index')}}">
            <x-primary-button class="bg-gradient-to-r from-purple-400 to-fuchsia-200 w-5/12 h-48 hover:duration-300 hover:scale-105">
                問題一覧
            </x-primary-button>
        </a>
        <a href="{{route('private')}}">
            <x-primary-button class="bg-gradient-to-r from-purple-400 to-fuchsia-200 w-5/12 h-48 hover:duration-300 hover:scale-105">
                非公開の問題一覧
            </x-primary-button>
        </a>
    </div>
</x-app-layout>