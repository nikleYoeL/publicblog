<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Профиль</title>
</head>
<body class="bg-slate-100">
    <x-header.layout>
        <x-Profile.nav :user="$user"/>
        <x-header.login />
    </x-header.layout>
    
    <div class="relative container mx-auto">
        <x-statusbar />

        <div class="flex xl:w-2/3 xl:mx-auto">
            <div class="flex flex-wrap items-start w-full">
                <div class="flex flex-col w-36 h-44 mr-2">
                    <img src="{{ asset('storage/' . $user->avatar) }}" height="100%" width="100%" alt="Фото профиля">
                </div>

                <div class="max-sm:order-3 flex flex-col w-full sm:w-3/4 sm:ml-auto">
                    <div class="flex">
                        <h2 class="w-1/2 mr-2 py-1">Имя пользователя</h2>
                        <p class="w-full px-1 py-1 text-gray-500 border-b border-sky-700/50">{{ $user->name }}</p>
                    </div>

                    @if (request()->user() !== null
                                            && (request()->user()->id == $user->id
                                            || request()->user()->hasAnyRole(['super-admin', 'admin'])))
                    <div class="flex flex-row">
                        <h2 class="w-1/2 mr-2 py-1">Почта</h2>
                        <div class="flex flex-wrap w-full px-1 py-1 text-gray-500 border-b border-sky-700/50">
                            <p>{{ $user->email }}</p>
                            @if(request()->user()->id === $user->id)
                                @if($user->isVerified())
                                    <x-svg-check />
                                @else
                                <form action="{{ route('verification.send') }}" method="post" class="min-[450px]:ml-3">
                                    @csrf
                                    <button type="submit" class="text-sm text-sky-500 hover:text-sky-700">подтвердить</button>
                                </form>
                                @endif
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="flex">
                        <h2 class="w-1/2 mr-2 py-1">О себе</h2>
                        <p class="w-full px-1 py-1 text-gray-500 border-b border-sky-700/50">
                            @if($user->bio)
                            {!! nl2br($user->bio) !!}
                            @else
                            Здесь могла быть ваша реклама
                            @endif
                        </p>
                    </div>
                </div>

                @auth
                @if (request()->user() && request()->user()->id === $user->id)
                <div class="drop-down max-sm:order-2 relative w-fit max-sm:ml-auto sm:my-3 px-3 py-1 text-white bg-slate-800 hover:bg-sky-900 select-none cursor-pointer">
                    <span class="max-md:py-3 group-hover:text-sky-600">Редактировать</span>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    
                    <ul class="hidden absolute top-full left-0 right-0 text-center whitespace-nowrap bg-slate-700 divide-y">
                        @if ($user->id == request()->user()->id && $user->avatar !== $user->getDefaultImage())
                        <li class="py-1 hover:bg-sky-900">
                            <form action="{{ route('profile.delete-avatar', $user) }}" method="post" class="hover:text-sky-600">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <button type="submit">Удалить фото</button>
                                </button>
                            </form>
                        </li>
                        @endif

                        <li class="py-1 hover:bg-sky-900">
                            <x-nav-link href="{{ route('profile.edit', ['profile' => $user]) }}">Изменить профиль</x-nav-link>
                        </li>


                        <li class="py-1 hover:bg-sky-900">
                            <form action="{{ route('profile.destroy', $user) }}" method="post" class="hover:text-sky-600">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Удалить профиль</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>
</body>
</html>