<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            問題を作成しました
        </h2>
    </x-slot>
    <div>
        <a href="{{route('post.create')}}">
            <x-primary-button class="mt-4">
                続けて作る
            </x-primary-button>
        </a>

        <a href="{{route('self')}}">
            <x-primary-button class="mt-4">
                作った問題一覧へ
            </x-primary-button>
        </a>

        <a href="{{route('post.index')}}">
            <x-primary-button class="mt-4">
                問題を解く
            </x-primary-button>
        </a>

        <a href="{{route('dashboard')}}">
            <x-primary-button class="mt-4">
                プロフィールへ
            </x-primary-button>
        </a>
    </div>
    
</x-app-layout>
