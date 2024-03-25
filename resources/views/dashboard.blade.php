<x-app-layout>
    <div class="bg-gradient-to-t from-gray-200 to-white">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center py-4">
            your name : <span class="text-3xl">{{$user[0]->name}}</span>
        </h2>
        <div class="flex justify-center items-center gap-4 mt-2">
            <a href="{{route('profile.edit')}}">
                <x-primary-button class="hover:bg-green-700">
                    {{ __('Profile') }}
                </x-primary-button> 
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-primary-button :href="route('logout')"
                        class="hover:bg-red-700"
                        onclick="return confirm('本当にログアウトしますか？')">
                    {{ __('Log Out') }}
                </x-primary-button>
            </form>
        </div>

    <div class="w-full m-auto py-4">
        <div class="mx-auto text-center space-x-4">
            <a href="{{route('post.create')}}">
                <x-primary-button class="group w-2/5 h-64 hover:duration-500 hover:scale-105 hover:bg-gradient-to-l
                bg-gradient-to-r from-cyan-500 to-blue-200 relative">
                    <p class="group-hover:opacity-30 text-4xl">    
                        作る
                    </p>
                    <div class="opacity-0 group-hover:opacity-100 absolute text-black">
                        <h2 class="text-lg pb-2">
                            問題を作成する
                        </h2>
                        <p>オリジナルの4択クイズを作ってみよう！</p>
                    </div>
                </x-primary-button>
            </a>
            <a href="{{route('post.index')}}">
                <x-primary-button class="group w-2/5 h-64 hover:duration-300 hover:scale-105 hover:bg-gradient-to-l
                bg-gradient-to-r from-purple-400 to-fuchsia-200 relative">
                    <p class="group-hover:opacity-30 text-4xl">    
                        解く
                    </p>
                    <div class="opacity-0 group-hover:opacity-100 absolute text-black">
                        <h2 class="text-lg pb-2">
                            問題を解く
                        </h2>
                        <p>みんなが作った問題にチャレンジ！</p>
                    </div>
                </x-primary-button>
            </a>
        </div>

        <div class="mx-auto text-center space-x-4 mt-4">
            <a href="{{route('self')}}">
                <x-primary-button class="group w-2/5 h-64 hover:duration-300 hover:scale-105 hover:bg-gradient-to-l
                                          bg-gradient-to-r from-emerald-400 to-emerald-100 relative">
                    <p class="group-hover:opacity-30 text-4xl">    
                        自作問題
                    </p>
                    <div class="opacity-0 group-hover:opacity-100 absolute text-black">
                        <h2 class="text-lg pb-2">
                            自作問題
                        </h2>
                        <p>自分が作った問題をチェック！編集や削除もここから！</p>
                    </div>
                </x-primary-button>
            </a>
            <a href="{{route('wrong_index')}}">
                <x-primary-button class="group w-2/5 h-64 hover:duration-300 hover:scale-105 hover:bg-gradient-to-l
                bg-gradient-to-r from-red-500 to-orange-200 relative">
                    <p class="group-hover:opacity-30 text-4xl">    
                        間違え
                    </p>
                    <div class="opacity-0 group-hover:opacity-100 absolute text-black">
                        <h2 class="text-lg pb-2">
                            間違えた問題の一覧
                        </h2>
                        <p>過去に不正解だった問題の一覧。もう一度解いてみよう！</p>
                    </div>
                </x-primary-button>
            </a>
        </div>
    </div>
    </div>
</x-app-layout>