<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            問題作成
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <form method="post" action="{{route('post.store')}}">
            @csrf
            <div class="w-full flex flex-col">
                <label for="title" class="font-semibold mt-4">タイトル（作品名など）</label>
                <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="title">
            </div>

            <div enctype='multipart/form-data' class="mt-8">
                <label for="image" class="font-semibold mt-4">画像（必要ならば）</label>
                <input type="file" name="image">
            </div>

            <div class="w-full flex flex-col">
                <label for="question" class="font-semibold mt-4">問題文</label>
                <textarea name="question" class="w-auto py-2 border border-gray-300 rounded-md"
                id="question" cols="30" rows="5"></textarea>
            </div>

            <div>
                <label class="label" class="font-semibold mt-4">選択肢1 : </label>
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices">
            </div>
            <div>
                <label class="label" class="font-semibold mt-4">選択肢2 : </label>
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices">
            </div>
            <div>
                <label class="label" class="font-semibold mt-4">選択肢3 : </label>
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices">
            </div>
            <div>
                <label class="label" class="font-semibold mt-4">選択肢4 : </label>
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices">
            </div>
            <div>
                <label class="label" class="font-semibold mt-4">正解の選択肢</label>
                <select name="correct_choice">
                    <option value="1">選択肢1</option>
                    <option value="2">選択肢2</option>
                    <option value="3">選択肢3</option>
                    <option value="4">選択肢4</option>
                </select>
            </div>

            <x-primary-button class="mt-4">
                作成する
            </x-primary-button>
        </form>

        <a href="{{route('dashboard')}}">
            <x-primary-button class="mt-4">
                戻る
            </x-primary-button>
        </a>
    </div>
</x-app-layout>
