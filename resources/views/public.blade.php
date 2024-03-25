<x-app-layout>
    <div class="bg-gradient-to-r from-emerald-200 to-emerald-100">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center py-4">
            自作問題一覧→公開済み
        </h2>
    <div class="mx-auto px-6">
        <div class="flex">
            <form action="{{ route('public') }}" method="get" class="flex-1">
                @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <x-primary-button class="hover:bg-gray-500">
                        検索
                    </x-primary-button>
            </form>
            <div class="flex flex-2 text-right">
                <p class="hover:text-blue-500">
                    <a href="{{route('self')}}">
                        全て
                    </a>
                </p>
                <p class="ml-4 hover:text-blue-500">
                    <a href="{{route('public')}}">
                        公開済み
                    </a>
                </p>
                <p class="ml-4 hover:text-blue-500">
                    <a href="{{route('selfPrivate')}}">
                        非公開
                    </a>
                </p>
            </div>
        </div>
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <div class="flex">
                <h1 class="px-2 text-lg font-semibold">
                    {{$post->title}}
                </h1>
                
                <div class="text-right flex-1">
                    <a href="{{route('post.edit', $post)}}">
                        <x-primary-button class="bg-green-700">
                            編集
                        </x-primary-button>
                    </a>
                </div>
                
                <form method="post" action="{{route('post.destroy', $post)}}" class="text-right flex-2" onclick='return confirm("本当に削除しますか？")'>
                    @csrf
                    @method('delete')
                    <x-primary-button class="bg-red-700 ml-2">
                         削除
                     </x-primary-button>
                </form>
            </div>
            <img>

            <hr class="w-full">
            <p class="px-4 py-2">
                {{$post->question}}
            </p>
            <div class="px-4 text-sm font-semibold text-right">
                <p>
                    作成日(最終更新日)：{{$post->updated_at}}
                </p>
            </div>
        </div>
        @endforeach
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>
