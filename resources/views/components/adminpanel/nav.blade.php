<nav class="max-md:text-lg">
    <div id="burger" class="md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="open inline-block w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="close hidden w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>
    <ul class="hidden max-md:absolute top-12 left-0 right-0 md:flex font-bold max-md:bg-slate-700 max-md:divide-y select-none cursor-pointer">
        <li class="px-2 max-md:py-3">
            <x-nav-link href="{{ route('post.listing') }}">Главная</x-nav-link>
        </li>
        <li class="drop-down max-md:relative px-2 max-md:py-3 group">
            <span class="max-md:py-3 group-hover:text-sky-600 select-none cursor-pointer">Пользователи</span>
            
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
            
            <ul class="hidden absolute max-md:top-full max-md:left-0 max-md:right-0 z-10 bg-slate-800 md:bg-slate-700">
                <li class="max-md:py-3">
                    <x-nav-link href="{{ route('user.index') }}" class="inline-block w-full px-2">Пользователи</x-nav-link>
                </li>
                <li class="max-md:py-3">
                    <x-nav-link href="{{ route('role.index') }}" class="inline-block w-full px-2">Роли</x-nav-link>
                </li>
                <li class="max-md:py-3">
                    <x-nav-link href="{{ route('permission.index') }}" class="inline-block w-full px-2">Права</x-nav-link>
                </li>
            </ul>
        </li>
        <li class="drop-down max-md:relative px-2 max-md:py-3 group">
            <span class="max-md:py-3 group-hover:text-sky-600 select-none cursor-pointer">Статьи</span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>

            <ul class="hidden absolute max-md:top-full max-md:left-0 max-md:right-0 z-10 bg-slate-800 md:bg-slate-700 divide-y">
                <li class="max-md:py-3">
                    <x-nav-link href="{{ route('post.index') }}" class="inline-block w-full px-2">Все статьи</x-nav-link>
                </li>
                <li class="max-md:py-3">
                    <x-nav-link href="{{ route('publication.index') }}" class="inline-block w-full px-2">Публикация статей</x-nav-link>
                </li>
                <li class="max-md:py-3">
                    <x-nav-link href="{{ route('category.index') }}" class="inline-block w-full px-2">Категории</x-nav-link>
                </li>
            </ul>
        </li>
    </ul>
</nav>