<nav {{ $attributes->class(['max-md:text-lg'])->merge(['']) }}>
    <div id="burger" class="md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="open inline-block w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="close hidden w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>
    <ul class="hidden max-md:absolute top-12 left-0 right-0 md:flex font-bold max-md:bg-slate-700 max-md:divide-y select-none cursor-pointer">
        <li class="px-2 max-md:py-2">
            <x-nav-link href="{{ route('post.listing') }}">Главная</x-nav-link>
        </li>
        <li class="px-2 max-md:py-2">
            <x-nav-link href="{{ route('profile.show', $user) }}">Профиль</x-nav-link>
        </li>
        <li class="px-2 max-md:py-2">
            <x-nav-link href="{{ route('profile.posts', $user) }}">
                @if ($user->id == request()->user()->id)
                    Мои статьи
                @else
                    Статьи пользователя
                @endif
            </x-nav-link>
        </li>
    </ul>
</nav>