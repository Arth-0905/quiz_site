<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            問題一覧
        </h2>
    </x-slot>

    <div class="mx-auto px-6">
        <form action="{{ route('post.index') }}" method="get">
            @csrf
                <input type="text" name="keyword" value="{{ $keyword }}">
                <x-primary-button>
                    検索
                </x-primary-button>
        </form>

        @foreach($posts as $post)
        <a href="{{route('post.show', $post)}}">
            <div class="mt-4 p-8 bg-white w-full rounded-2xl">
                <h1 class="p-4 text-lg font-semibold">
                    {{$post->title}}
                </h1>
                <hr class="w-full">
                <p class="mt-4 p-4">
                    {{$post->question}}
                </p>
                <div class="p-4 text-sm font-semibold">
                    <p>
                        {{$post->user->name}}
                    </p>
                </div>
            </div>
        </a>
        @endforeach
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>