<x-app-layout>
        <x-slot name="header">
            <h2 class="py-10 text-center font-semibold ont-semibold text-9xl text-gray-800 leading-tight">
            @if ($isCorrect)
                <span class="text-red-600">正解！</span>
            @else
                <span class="text-blue-600">不正解</span>
            @endif
            </h2>
            <div class="flex px-4">
                @if ($previousQuestionId)
                <p class="text-left flex-1">
                <a href="{{route('wrong_show', $previousQuestionId)}}" class="link hover:text-blue-500">前の問題へ</a>
                </p>
                @endif
                @if ($nextQuestionId)
                <p class="text-right flex-2">
                <a href="{{ route('wrong_show', $nextQuestionId) }}" class="link hover:text-blue-500">次の問題へ</a> 
                </p>
                @endif
            </div>
        </x-slot>

        <div class="w-full m-auto space-x-2 py-2 text-center bg-white pb-40">
            <a href="{{route('dashboard')}}">
                <x-primary-button class="bg-gradient-to-r from-gray-500 to-gray-100 w-3/12 h-48 hover:duration-300 hover:scale-105">
                    メイン画面へ
                </x-primary-button>
            </a>
            <a href="{{url()->previous()}}">
                <x-primary-button class="bg-gradient-to-r from-purple-400 to-fuchsia-200 w-3/12 h-48 hover:duration-300 hover:scale-105">
                    もう一度解く
                </x-primary-button>
            </a>
            <a href="{{route('wrong_index')}}">
                <x-primary-button class="bg-gradient-to-r from-red-500 to-orange-200 w-3/12 h-48 hover:duration-300 hover:scale-105">
                    間違えた問題一覧へ戻る
                </x-primary-button>
            </a>
        </div>
</x-app-layout>