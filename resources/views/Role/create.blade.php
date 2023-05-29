<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Создать роль</title>
</head>
<body class="bg-neutral-200">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>

    <div class="container mx-auto">
        <x-Form.form action="{{ route('role.store') }}" class="w-full sm:w-2/3 lg:w-1/3 md:my-auto">
            <x-Form.label for="roleName">Наименование роли:</x-Form.label>
            <x-Form.input type="text" id="roleName" name="name" autofocus />
            <x-Form.submit >Создать</x-Form.submit>
        </x-Form.form>
    </div>
</body>
</html>