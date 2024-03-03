<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            自分で作った問題
        </h2>
    </x-slot>

    <div class="mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <form action="{{ route('post.index') }}" method="get">
            @csrf
                <input type="text" name="keyword" value="{{ $keyword }}">
                <x-primary-button>
                    検索
                </x-primary-button>
        </form>
        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <div class="flex">
                <h1 class="p-4 text-lg font-semibold">
                    {{$post->title}}
                </h1>
                
                <div class="text-right flex-1">
                    <a href="{{route('post.edit', $post)}}">
                        <x-primary-button>
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
            <p class="mt-4 p-4">
                {{$post->question}}
            </p>
            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}}
                </p>
            </div>
        </div>
        @endforeach
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>
