<x-app-layout>
    <div class="mx-auto px-6 bg-gradient-to-r from-purple-200 via-rose-100 to-purple-200">
        <h2 class="font-semibold text-3xl text-center text-gray-800 leading-tight py-4">
            間違えた問題
        </h2>
        <div class="flex">
            <form action="{{ route('wrong_index') }}" method="get" class="flex-1">
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
                <p class="ml-4">
                    <a href="{{route('wrong_index')}}" class="hover:text-blue-500">
                        間違えた問題
                    </a>
                </p>
            </div>
        </div>

        <div class="grid grid-cols-3 space-x-3 space-y-2">
            @foreach($posts as $post)
            <a href="{{route('wrong_show', $post)}}">
                <div class="mt-4 p-8 bg-white rounded-2xl h-80 relative hover:duration-300
                                group hover:scale-105 hover:bg-gradient-to-r from-purple-400 to-fuchsia-200">
                    <h1 class="p-4 text-lg font-semibold">
                        {{$post->title}}
                    </h1>
                    <hr class="w-full">
                    <p class="mt-4 p-4">
                        {{$post->question}}
                    </p>
                    <p class="p-4 text-sm font-semibold w-full absolute top-64">
                        {{$post->user->name}}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>