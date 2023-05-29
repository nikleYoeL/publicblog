<div {{ $attributes->class(['flex', 'justify-end', 'items-center'])->merge(['']) }}>
    @guest
        <a href="{{ route('login') }}" class="border border-sky-700 px-3 py-1 hover:bg-sky-900 hover:border-sky-900">Войти</a>
    @endguest
    @auth
        <div class="drop-down sm:relative w-full px-3 py-1 border border-sky-700 font-bold group hover:bg-sky-900 hover:border-sky-900 select-none cursor-pointer">
            <span>{{ strtoupper(Auth::user()->name) }}</span>
            <ul class="hidden absolute top-full max-sm:left-0 right-0 z-10 max-sm:min-w-full min-w-max w-full divide-y bg-slate-700 text-center sm:text-right max-sm:text-lg">
                @hasanyrole(['super-admin', 'admin'])
                <li class="max-sm:py-2 hover:bg-sky-900">
                    <a href="{{ route('user.index') }}" class="inline-block w-full px-2">Панель администратора</a>
                </li>
                @endhasanyrole
                <li class="max-sm:py-2 hover:bg-sky-900">
                    <a href="{{ route('profile.show', Auth::user()) }}" class="inline-block w-full px-2">Профиль</a>
                </li>
                <li class="max-sm:py-2 hover:bg-sky-900">
                    <form action="{{ route('logout', ['user' => Auth::user()]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-2 text-center sm:text-right">Выйти</button>
                    </form>
                </li>
            </ul>
        </div> 
    @endauth
</div>