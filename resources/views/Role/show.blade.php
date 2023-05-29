<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Роль: {{ $role->name }}</title>
</head>
<body class="flex flex-col min-h-screen bg-neutral-200">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>

    <div class="container flex flex-col mx-auto">
        <x-statusbar />

        <div class="flex flex-col w-full md:w-3/5 p-3 mx-auto bg-white">
            <header class="flex justify-between text-2xl">
                <h1>
                    Роль:
                    <span class="capitalize">{{ $role->name }}</span>
                </h1>

                <div class="flex flex-row">
                    <a href="{{ route('role.edit', $role) }}">
                        <x-svg-edit />
                    </a>

                    <form action="{{ route('role.destroy', $role) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <x-svg-delete />
                        </button>
                    </form>
                </div>
            </header>

            <ul class="flex flex-row flex-wrap">
            @foreach ($permissions as $permission)
                <li class="w-full sm:w-1/2">
                    <input type="checkbox" name="" id="{{ $permission->name }}" @checked($role->hasPermissionTo($permission->name)) disabled>
                    <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</body>
</html>