<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Публикации</title>
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
                        <x-Table.th class="hidden md:table-cell">Категория</x-Table.th>
                        <x-Table.th>Автор</x-Table.th>
                        <x-Table.th class="hidden md:table-cell">Дата создания</x-Table.th>
                        <x-Table.th>Действия</x-Table.th>
                    </tr>
                </x-Table.thead>
                <x-Table.tbody>
                    @foreach ($posts as $post)
                        <x-Table.tr>
                            <x-Table.td>{{ $post->id }}</x-Table.td>

                            <x-Table.td>
                                <x-nav-link href="{{ route('post.show', [$post->slug]) }}" class="text-sky-700">{{ $post->title }}</x-nav-link>
                            </x-Table.td>

                            <x-Table.td class="hidden md:table-cell">{{ $post->category->name }}</x-Table.td>

                            <x-Table.td>
                                <x-nav-link href="{{ route('profile.show', $post->user) }}" class="text-sky-700">{{ $post->user->name }}</x-nav-link>
                            </x-Table.td>

                            <x-Table.td class="hidden md:table-cell">{{ $post->parseInCarbon('created_at')->format('H:i:s d.m.Y') }}</x-Table.td>

                            <x-Table.td class="flex">
                                <form action="{{ route('publication.store', $post->id) }}" method="post" class="mr-1">
                                    @csrf
                                    <button type="submit">
                                        <x-svg-check />
                                    </button>
                                </form>
    
                                <form action="{{ route('publication.destroy', $post->id) }}" method="post" class="ml-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <x-svg-x-mark />
                                    </button>
                                </form>
                            </x-Table.td>
                        </x-Table.tr>
                    @endforeach
                </x-Table.tbody>
            </x-Table.index>
        </div>

        <div class="flex justify-center items-center xl:w-2/3 xl:mx-auto">
            @if ($posts->hasPages())
                @unless ($posts->onFirstPage()) 
                    <x-nav-link href="{{ $posts->previousPageUrl() }}" class="mr-3">
                        <x-pagination-control-left />
                    </x-nav-link>
                @endunless

                {{ $posts->currentPage() }} 
            
                @if ($posts->hasMorePages())
                    <x-nav-link href="{{ $posts->nextPageUrl() }}" class="ml-3">
                        <x-pagination-control-right />
                    </x-nav-link>
                @endif
            @endif
        </div>
    </div> 
</body>
</html>