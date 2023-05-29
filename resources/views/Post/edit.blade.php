<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Редактирование статьи</title>
</head>
<body class="flex flex-col min-h-screen bg-slate-100">
    <x-header.layout>
        <x-header.nav />
        <x-header.search />
        <x-header.login />
    </x-header.layout>

    <x-Form.form action="{{ route('post.update', ['user' => Auth::user()->id, 'post' => $post]) }}" class="w-full md:w-3/5 xl:w-2/5 md:my-auto">
        @method('PUT')
        <x-Form.label for="title">Наименование статьи</x-Form.label>
        @if ($errors->has('title'))
            <ul class="text-red-500 text-sm">
                @foreach ($errors->get('title') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.input type="text" id="title" name="title" value="{{ $post->title }}" />

        <x-Form.label for="category">Категория</x-Form.label>
        <x-Form.select id="category" name="category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($post->category->id === $category->id)>{{ $category->name }}</option>
            @endforeach
        </x-Form.select>
        
        @if ($errors->has('body'))
            <ul class="text-red-500 text-sm">
                @foreach ($errors->get('body') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.textarea name="body" rows="6" placeholder="Основной текст статьи">{!! nl2br($post->body) !!}</x-Form.textarea>
        
        <x-Form.submit>Обновить</x-Form.submit>
    </x-Form.form>
</body>
</html>