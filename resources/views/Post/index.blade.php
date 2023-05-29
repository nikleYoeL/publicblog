<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Список статей</title>
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
                        <x-Table.th class="hidden md:table-cell">Автор</x-Table.th>
                        <x-Table.th class="hidden md:table-cell">Дата создания</x-Table.th>
                        <x-Table.th class="hidden md:table-cell">Комментарии</x-Table.th>
                        <x-Table.th class="hidden md:table-cell">Опубликован</x-Table.th>
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
                            <x-Table.td class="hidden md:table-cell">
                                <x-nav-link href="{{ route('profile.show', $post->user) }}" class="text-sky-700">{{ $post->user->name }}</x-nav-link>
                            </x-Table.td>
                            <x-Table.td class="hidden md:table-cell">{{ $post->parseInCarbon('created_at')->format('H:i:s d.m.Y') }}</x-Table.td>
                            <x-Table.td class="hidden md:table-cell text-center">{{ $post->comments->count() }}</x-Table.td>
                            <x-Table.td class="hidden md:table-cell text-center">
                                @if ($post->published)
                                    @can('unpublish post')
                                        <form action="{{ route('publication.update', $post->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <x-Form.secondary-submit class="text-red-600">Снять с публикации</x-Form.secondary-submit>
                                        </form>
                                    @endcan
                                @else
                                    <x-svg-nosymbol />
                                @endif
                            </x-Table.td>
                            <x-Table.td>
                                <ul class="flex">
                                    <li>
                                        <x-secondary-nav-link href="{{ route('post.show', $post) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-6 h-6 stroke-blue-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path class="fill-blue-400" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </x-secondary-nav-link>
                                    </li>
                                    <li class="mx-1">
                                        <x-secondary-nav-link href="{{ route('post.edit', $post) }}">
                                            <x-svg-edit />
                                        </x-secondary-nav-link>
                                    </li>
                                    <li class="md:hidden">
                                        @if ($post->published)
                                        @can('unpublish post')
                                            <form action="{{ route('publication.update', $post->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit">
                                                    <x-svg-nosymbol />
                                                </button>
                                            </form>
                                        @endcan
                                        @endif
                                    </li>
                                    <li>
                                        <form action="{{ route('post.destroy', $post) }}" method="post">
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