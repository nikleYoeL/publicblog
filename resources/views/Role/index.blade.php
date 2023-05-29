<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Роли</title>
</head>
<body class="flex flex-col min-h-screen bg-slate-100">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>
    
    <div class="flex flex-col lg:container lg:mx-auto">
        <x-statusbar />
        
        <div class="relative flex xl:w-2/3 xl:mx-auto">
            <x-Table.index>
                <x-Table.thead>
                    <tr class="bg-slate-50">
                        <x-Table.th>ID</x-Table.th>
                        <x-Table.th>Наименование</x-Table.th>
                        <x-Table.th>Кол-во прав</x-Table.th>
                        <x-Table.th>Действия</x-Table.th>
                    </tr>
                </x-Table.thead>
                <x-Table.tbody>
                    @foreach ($roles as $role)
                    <x-Table.tr>
                        <x-Table.td>{{ $role->id }}</x-Table.td>
                        <x-Table.td>{{ $role->name }}</x-Table.td>
                        <x-Table.td>{{ $role->permissions->count() }}</x-Table.td>
                        <x-Table.td>
                            <ul class="flex">
                                <li>
                                    <a href="{{ route('role.show', $role) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-6 h-6 stroke-blue-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path class="fill-blue-400" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('role.edit', $role) }}">
                                        <x-svg-edit />
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('role.destroy', $role) }}" method="post" class="inline-flex items-center justify-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <x-svg-delete />
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </x-Table.td>
                    </x-Table.tr>
                    @endforeach
                </x-Table.tbody>
            </x-Table.index>
        </div>

        <div class="flex justify-between items-center xl:w-2/3 xl:mx-auto my-3">
            <x-nav-link-button href="{{ route('role.create') }}">Создать роль</x-nav-link-button>

            <div class="flex justify-center items-center">
                @if ($roles->hasPages())
                    @unless ($roles->onFirstPage()) 
                        <x-nav-link href="{{ $roles->previousPageUrl() }}" class="mr-3">
                            <x-pagination-control-left />
                        </x-nav-link>
                    @endunless

                    {{ $roles->currentPage() }} 
                
                    @if ($roles->hasMorePages())
                        <x-nav-link href="{{ $roles->nextPageUrl() }}" class="ml-3">
                            <x-pagination-control-right />
                        </x-nav-link>
                    @endif
                @endif
            </div>
        </div>
    </div>
</body>
</html>