<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Категории</title>
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
                        <x-Table.th>Кол-во постов</x-Table.th>
                        <x-Table.th>Действия</x-Table.th>
                    </tr>
                </x-Table.thead>
                <x-Table.tbody>
                    @foreach ($categories as $category)
                    <x-Table.tr>
                        <x-Table.td>{{ $category->id }}</x-Table.td>
                        <x-Table.td>{{ $category->name }}</x-Table.td>
                        <x-Table.td>{{ $category->posts->count() }}</x-Table.td>
                        <x-Table.td>
                            <ul class="flex">
                                <li>
                                    <a href="{{ route('category.edit', $category) }}">
                                        <x-svg-edit />
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('category.destroy', $category) }}" method="post" class="inline-flex items-center justify-center">
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
            <x-nav-link-button href="{{ route('category.create') }}">Создать категорию</x-nav-link-button>

            <div class="flex justify-center items-center">
                @if ($categories->hasPages())
                    @unless ($categories->onFirstPage()) 
                        <x-nav-link href="{{ $categories->previousPageUrl() }}" class="mr-3">
                            <x-pagination-control-left />
                        </x-nav-link>
                    @endunless

                    {{ $categories->currentPage() }} 
                
                    @if ($categories->hasMorePages())
                        <x-nav-link href="{{ $categories->nextPageUrl() }}" class="ml-3">
                            <x-pagination-control-right />
                        </x-nav-link>
                    @endif
                @endif
            </div>
        </div>
    </div>

</body>
</html>