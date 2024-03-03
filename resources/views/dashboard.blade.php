<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール
        </h2>
    </x-slot>

    <div class="py-12 container">
        <div class="ml-4">
            <h1 class="font-semibold">
                your name : 
            </h1>
        </div>

        <div>
            <a href="{{route('self')}}">
                <x-primary-button>
                    作った問題一覧
                </x-primary-button>
            </a>
        </div>

        <a href="{{route('post.create')}}">
            <x-primary-button class="mt-4">
                問題を作成する
            </x-primary-button>
        </a>

        <a href="{{route('post.index')}}">
            <x-primary-button class="mt-4">
                問題を解く
            </x-primary-button>
        </a>

    </div>
</x-app-layout>
