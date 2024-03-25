<x-app-layout>
    
    <h2 class="py-24 font-semibold text-3xl text-gray-800 leading-tight text-center">
        問題を更新しました
    </h2>

    <div class="w-full m-auto space-x-2 py-2 text-center">
        <a href="{{route('self')}}">
            <x-primary-button class="text-black bg-gradient-to-r from-emerald-400 to-emerald-100 w-3/12 h-48 hover:duration-300 hover:scale-105">
                自作問題一覧へ戻る
            </x-primary-button>
        </a>
        <a href="{{route('post.create')}}">
            <x-primary-button class="text-black bg-gradient-to-r from-cyan-500 to-blue-200 w-3/12 h-48 hover:duration-300 hover:scale-105">
                新しく問題を作る
            </x-primary-button>
        </a>
        <a href="{{route('post.index')}}">
            <x-primary-button class="text-black bg-gradient-to-r from-purple-400 to-fuchsia-200 w-3/12 h-48 hover:duration-300 hover:scale-105">
                問題を解く
            </x-primary-button>
        </a>
    </div>
    <div class="w-full m-auto py-2 px-2 text-center pb-28">
        <a href="{{route('dashboard')}}">
            <x-primary-button class="bg-gradient-to-r from-gray-500 to-slate-200 w-3/4 h-28 hover:duration-300 hover:scale-105">
                メイン画面へ
            </x-primary-button>
        </a>
    </div>
    </div>
</x-app-layout>
