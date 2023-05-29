<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Роли пользователя {{ $user->name }}</title>
</head>
<body class="bg-neutral-200">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>

    <div class="container mx-auto">
        <x-Form.form action="{{ route('user.role-update', $user) }}" class="w-full sm:w-2/3 lg:w-1/3 md:my-auto">
            @method('PUT')
            <h2 class="font-bold">Роли</h2>
            <ul>
            @foreach ($roles as $role)
            @if ($role->id === 1 && !(Auth::user()->hasRole('super-admin')))
                @continue
            @endif
            <li>
                <input type="checkbox" name="{{ $role->id }}"
                @checked($user->hasRole($role->name))>
                {{ $role->name }}
            </li>
            @endforeach
            </ul>
            <x-Form.submit >Обновить</x-Form.submit>
        </x-Form.form>
    </div>
</body>
</html>