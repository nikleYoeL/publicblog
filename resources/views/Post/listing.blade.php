<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Главная страница</title>
</head>
<body class="bg-slate-100">
    <x-header.layout>
        <x-header.nav />
        <x-header.search />
        <x-header.login />
    </x-header.layout>
    
    <div class="relative container mx-auto">
        <x-statusbar />
        <ul>
        @forelse ($posts as $post)
            <li class="mb-3">
                <x-Post.article>
                    <x-Post.header>
                        <x-Post.header-up :post="$post" />
                        <x-Post.header-down :post="$post" />
                    </x-Post.header>
                    <div class="px-1">
                        <x-Post.body :post="$post" class="max-h-20 mb-3 leading-loose text-clip overflow-y-hidden"/>
                        
                        <x-nav-link href="{{ route('post.show', $post) }}" class="text-cyan-700">
                            Читать далее
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="inline-block w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </x-nav-link>
                    </div>
                </x-Post.article>
            </li>
        @empty
        <p class="xl:w-2/3 xl:mx-auto mb-6">По вашему запросу ничего не найдено</p>
        @endforelse
        </ul>
        <div class="flex justify-between items-end xl:w-2/3 xl:mx-auto mb-12 px-1 sm:px-0">
            <x-nav-link-button href="{{ route('post.create') }}">Добавить статью</x-nav-link-button>

            <div class="flex justify-center items-center">
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
    </div>
</body>
</html>