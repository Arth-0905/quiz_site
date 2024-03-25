<x-app-layout>
    <div class="bg-gradient-to-t from-cyan-400 to-blue-100">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center py-4">
            問題作成
        </h2>
    <div class="max-w-7xl mx-auto px-6 w-4/5">
        <form method="post" action="{{route('post.store')}}" enctype='multipart/form-data'>
            @csrf
            <div class="w-full flex flex-col">
                <label for="title" class="font-semibold mt-4">タイトル（作品名など）</label>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="title" value="{{old('title')}}">
            </div>

            <div class="mt-8">
                <label for="image" class="font-semibold mt-4">画像（必要ならば）</label>
                <input type="file" name="image">
            </div>

            <div class="w-full flex flex-col">
                <label for="question" class="font-semibold mt-4">問題文</label>
                <x-input-error :messages="$errors->get('question')" class="mt-2" />
                <textarea name="question" class="w-auto py-2 border border-gray-300 rounded-md"
                id="question" cols="30" rows="5">{{old('question')}}</textarea>
            </div>

            <div class="mt-4">
                <label class="label" class="font-semibold mt-4">選択肢1 : </label>
                <x-input-error :messages="$errors->get('choices')" class="mt-2" />
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices" value="{{old('choices[0]')}}">
            </div>
            <div>
                <label class="label" class="font-semibold mt-4">選択肢2 : </label>
                <x-input-error :messages="$errors->get('choices')" class="mt-2" />
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices" value="{{old('choices[1]')}}">
            </div>
            <div>
                <label class="label" class="font-semibold mt-4">選択肢3 : </label>
                <x-input-error :messages="$errors->get('choices')" class="mt-2" />
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices" value="{{old('choices[2]')}}">
            </div>
            <div>
                <label class="label" class="font-semibold mt-4">選択肢4 : </label>
                <x-input-error :messages="$errors->get('choices')" class="mt-2" />
                <input type="text" name="choices[]" class="w-auto py-2 border border-gray-300 rounded-md" id="choices" value="{{old('choices[3]')}}">
            </div>
            <div class="mt-4">
                <label class="label" class="font-semibold mt-4">正解の選択肢</label>
                <select name="correct_choice">
                    <option value="1">選択肢1</option>
                    <option value="2">選択肢2</option>
                    <option value="3">選択肢3</option>
                    <option value="4">選択肢4</option>
                </select>
            </div>
            <div class="mt-4">
                <label>
                    <input type="checkbox" name="release" id="release"> 非公開にする
                </label>
                <p class="mt-2">非公開にすると自分だけが閲覧可能になり公開されません。「問題を解く」の「非公開の問題」から回答できます。</p>
            </div>

            <x-primary-button class="hover:bg-blue-400 hover:text-black mt-4 text-3xl">
                作成する
            </x-primary-button>
        </form>

        <a href="{{route('dashboard')}}">
            <x-primary-button class="mt-4 hover:bg-gray-500">
                戻る
            </x-primary-button>
        </a>
    </div>
    </div>
</x-app-layout>
