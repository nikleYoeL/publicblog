<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Права</title>
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
                        <x-Table.th>Действия</x-Table.th>
                    </tr>
                </x-Table.thead>
                <x-Table.tbody>
                    @foreach ($permissions as $permission)
                    <x-Table.tr>
                        <x-Table.td>{{ $permission->id }}</x-Table.td>
                        <x-Table.td>{{ $permission->name }}</x-Table.td>
                        <x-Table.td>
                            <ul class="flex">
                                <li class="mr-1">
                                    <x-secondary-nav-link href="{{ route('permission.edit', $permission) }}">
                                        <x-svg-edit />
                                    </x-secondary-nav-link>
                                </li>
                                <li class="ml-1">
                                    <form action="{{ route('permission.destroy', $permission) }}" method="post">
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
            <x-nav-link-button href="{{ route('permission.create') }}">Создать право</x-nav-link-button>

            <div class="flex justify-center items-center">
                @if ($permissions->hasPages())
                    @unless ($permissions->onFirstPage()) 
                        <x-nav-link href="{{ $permissions->previousPageUrl() }}" class="mr-3">
                            <x-pagination-control-left />
                        </x-nav-link>
                    @endunless

                    {{ $permissions->currentPage() }} 
                
                    @if ($permissions->hasMorePages())
                        <x-nav-link href="{{ $permissions->nextPageUrl() }}" class="ml-3">
                            <x-pagination-control-right />
                        </x-nav-link>
                    @endif
                @endif
            </div>
        </div>
    </div>
</body>
</html>