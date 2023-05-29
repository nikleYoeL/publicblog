<nav class="flex flex-col justify-center max-md:text-lg">
    <div id="burger" class="md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="open inline-block w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="close hidden w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>
    <ul class="hidden max-md:absolute top-12 left-0 right-0 md:flex font-bold max-md:bg-slate-700 max-md:divide-y select-none cursor-pointer">
        <li class="px-2 max-md:py-3">
            <x-nav-link href="{{ route('post.listing') }}">Все статьи</x-nav-link>
        </li>
        <li class="px-2 max-md:py-3">
            <x-nav-link href="{{ route('post.popular') }}">Популярные</x-nav-link>
        </li>
        <li class="drop-down relative pl-2 pr-1 max-md:py-3 group">
            <span class="group-hover:text-sky-600">Категории</span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>

            <ul class="hidden absolute top-full left-0 right-0 bg-slate-800 md:bg-slate-700 divide-y">
                @foreach ($categories as $category)
                    <li class="max-md:py-2 hover:bg-sky-900">
                        <a href="{{ route('post.category', $category) }}" class="inline-block w-full px-1">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</nav>