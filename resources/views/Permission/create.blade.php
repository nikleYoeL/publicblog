<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Создать право</title>
</head>
<body class="bg-neutral-200">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>

    <div class="container mx-auto">
        <x-Form.form action="{{ route('permission.store') }}" class="w-full sm:w-2/3 lg:w-1/3 md:my-auto">
            <x-Form.label for="permissionName">Название права:</x-Form.label>
            @if ($errors->has('name'))
            @foreach ($errors->get('name') as $error)
                {{ $error }}
            @endforeach
            @endif
            <x-Form.input type="text" id="permissionName" name="name" autofocus />
            <x-Form.submit >Создать</x-Form.submit>
        </x-Form.form>
    </div>
</body>
</html>