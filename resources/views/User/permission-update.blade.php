<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Права пользователя {{ $user->name }}</title>
</head>
<body class="bg-slate-100">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>

    <div class="container mx-auto">
        <x-Form.form action="{{ route('user.permission-update', $user) }}" class="w-full sm:w-2/3 xl:w-1/3 md:my-auto">
            @method('PUT')
            <h2 class="font-bold">Права</h2>
            <ul class="flex flex-row flex-wrap">
            @foreach ($permissions as $permission)
            <li class="w-full sm:w-1/2">
                <input type="checkbox" name="{{ $permission->id }}"
                @checked($user->hasDirectPermission($permission->name))>
                {{ $permission->name }}
            </li>
            @endforeach
            </ul>
            <x-Form.submit >Обновить</x-Form.submit>
        </x-Form.form>
    </div>
</body>
</html>