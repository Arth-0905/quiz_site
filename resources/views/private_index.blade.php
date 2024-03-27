<x-app-layout>
    <div class="mx-auto px-6 min-h-screen bg-gradient-to-r from-purple-200 via-rose-100 to-purple-200">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center py-4">
            非公開の問題
        </h2>
        <div class="flex">
            <form action="{{ route('private') }}" method="get" class="flex-1">
                @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <x-primary-button>
                        検索
                    </x-primary-button>
            </form>
            <div class="flex flex-2 text-right pt-4">
                <p>
                    <a href="{{route('post.index')}}" class="hover:text-blue-500">
                        問題一覧
                    </a>
                </p>
                <p class="ml-4">
                    <a href="{{route('private')}}" class="hover:text-blue-500">
                        非公開の問題
                    </a>
                </p>
            </div>
        </div>

        @if($posts === null)
        <h1>非公開にしている問題はありません</h1>
        @endif

        <div class="grid grid-cols-3 space-x-3 space-y-2 pb-4">
            @foreach($posts as $post)
            <a href="{{route('post.show', $post)}}">
                <div class="mt-4 p-8 bg-white rounded-2xl h-80 relative hover:duration-300
                            group hover:scale-105 hover:bg-gradient-to-r from-purple-400 to-fuchsia-200">
                    <h1 class="p-4 text-lg font-semibold">
                        {{$post->title}}
                    </h1>
                    <hr class="w-full">
                    <p class="mt-4 p-4">
                        {{$post->question}}
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="flex">
            <p class="hover:text-blue-500 mx-4">
                <a href="{{route('dashboard')}}">
                    メイン画面へ戻る
                </a>
            </p>
        </div>
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>