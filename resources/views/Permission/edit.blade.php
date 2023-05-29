<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Редактировать право</title>
</head>
<body class="flex flex-col min-h-screen bg-neutral-200">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>

    <div class="container mx-auto flex flex-col">
        <x-Form.form action="{{ route('permission.update', $permission) }}" class="w-full sm:w-2/3 lg:w-1/3 md:my-auto">
            @method('PUT')
            
            <div class="my-2">
                <x-Form.label for="permissionName">Наименование:</x-Form.label>
                @if ($errors->has('name'))
                    <ul>
                        @foreach ($errors->get('name') as $error)
                            <li class="text-sm text-red-500">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <x-Form.input type="text" id="permissionName" name="name" value="{{ $permission->name }}" class="text-2xl" />
            </div>

            <x-Form.submit>Обновить</x-Form.submit>
        </x-Form.form>
    </div>
</body>
</html>