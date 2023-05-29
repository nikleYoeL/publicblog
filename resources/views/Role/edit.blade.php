<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Редактировать роль</title>
</head>
<body class="flex flex-col min-h-screen bg-neutral-200">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>

    <div class="container mx-auto flex flex-col">
        <x-Form.form action="{{ route('role.update', $role) }}" class="w-full sm:w-2/3 xl:w-1/3 md:my-auto">
            @method('PUT')
            
            <div class="my-2">
                <x-Form.label for="roleName">Имя:</x-Form.label>
                @if ($errors->has('name'))
                    <ul>
                        @foreach ($errors->get('name') as $error)
                            <li class="text-sm text-red-500">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <x-Form.input type="text" id="roleName" name="name" value="{{ $role->name }}" class="text-2xl" />
            </div>


            <fieldset>
                <legend class="uppercase text-sm font-semibold">Права:</legend>
                <ul class="flex flex-row flex-wrap">
                @foreach ($permissions as $permission)
                    <li class="w-full sm:w-1/2">
                        <input type="checkbox" name="permission[{{ $permission->id }}]" id="{{ $permission->name }}" @checked($role->hasPermissionTo($permission->name))>
                        <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                    </li>
                @endforeach
                </ul>
            </fieldset>

            <x-Form.submit>Обновить</x-Form.submit>
        </x-Form.form>
    </div>
</body>
</html>