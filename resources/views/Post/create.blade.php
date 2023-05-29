<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Создание статьи</title>
</head>
<body class="flex flex-col min-h-screen bg-slate-100">
    <x-header.layout>
        <x-header.nav />
        <x-header.search />
        <x-header.login />
    </x-header.layout>

    <x-Form.form action="{{ route('post.store') }}" class="w-full md:w-3/5 xl:w-2/5 md:my-auto">
        <x-Form.label for="title">Наименование статьи</x-Form.label>
        <x-Form.input type="text" name="title" id="title" />
        <x-Form.label for="category">Категория</x-Form.label>
        <x-Form.select id="category" name="category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-Form.select>
        <x-Form.textarea name="body" rows="6" placeholder="Основной тектс статьи" />
        <x-Form.submit>Опубликовать</x-Form.submit>
    </x-Form.form>
</body>
</html>