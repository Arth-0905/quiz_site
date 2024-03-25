<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight text-center">
            {{$post->title}}
        </h1>
    </x-slot>

    <div class="py-2 w-5/6 m-auto">
        <div class="bg-white w-full rounded-2xl">
            <div class="p-4 text-center">
                <h1 class="py-2">
                    問題
                </h1>

                @if(!empty($post->path))
                <img src="{{asset($post->path)}}">
                @endif
                
                <p class="">
                    {{$post->question}}
                </p>
                <div class="question-wrap">
                        @foreach($post->choices as $index => $choice)
                            <div class="my-2 hover:text-green-500 text-lg">
                                <label>
                                    <input type="radio" name="choice" value="{{ $index }}" required>
                                    {{ $choice }}
                                </label>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>