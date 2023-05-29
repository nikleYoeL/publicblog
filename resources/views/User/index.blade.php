<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Пользователи</title>
</head>
<body class="flex flex-col min-h-screen bg-slate-100">
    <x-header.layout>
        <x-adminpanel.nav />
        <x-header.login />
    </x-header.layout>
    
    <div class="flex flex-col lg:container lg:mx-auto">
        <x-statusbar />
        
        <div class="relative flex flex-col xl:w-2/3 xl:mx-auto">
            <x-Table.index>
                <x-Table.thead>
                    <tr class="bg-slate-50">
                        <x-Table.th>ID</x-Table.th>
                        <x-Table.th>Имя</x-Table.th>
                        <x-Table.th class="hidden min-[410px]:table-cell">Почта</x-Table.th>
                        <x-Table.th class="hidden lg:table-cell">Подтверждён</x-Table.th>
                        <x-Table.th class="hidden lg:table-cell">Посты</x-Table.th>
                        <x-Table.th class="hidden lg:table-cell">Роли</x-Table.th>
                        <x-Table.th class="hidden lg:table-cell">Права</x-Table.th>
                        <x-Table.th class="hidden md:table-cell">Блокировка</x-Table.th>
                        <x-Table.th>Действия</x-Table.th>
                    </tr>
                </x-Table.thead>
                <x-Table.tbody>
                    @foreach ($users as $user)
                    <x-Table.tr>
                        <x-Table.td>{{ $user->id }}</x-Table.td>
                        <x-Table.td>
                            <x-nav-link href="{{ route('profile.show', $user) }}" class="text-sky-700">{{ $user->name }}</x-nav-link>
                        </x-Table.td>
                        <x-Table.td class="hidden min-[410px]:table-cell">{{ $user->email }}</x-Table.td>
                        <x-Table.td class="hidden lg:table-cell text-center">
                            @if ($user->isVerified())
                                <x-svg-check />
                            @else
                                <x-svg-x-mark />
                            @endif
                        </x-Table.td>
                        <x-Table.td class="hidden lg:table-cell text-center">{{ $user->posts->count() }}</x-Table.td>
                        <x-Table.td class="hidden lg:table-cell">
                            <ul>
                                @foreach ($user->roles->sortBy('id') as $role)
                                <li>{{ $role->name }}</li>
                                @endforeach
                            </ul>
                        </x-Table.td>
                        <x-Table.td class="hidden lg:table-cell text-center">
                            {{ $user->permissions->count() }}
                        </x-Table.td>
                        <x-Table.td class="hidden md:table-cell">                
                            @if ($user->id === Auth::user()->id)
                                <div class="hidden"></div>
                            @elseif ($user->hasRole('super-admin') && !Auth::user()->hasRole('super-admin'))
                                <span class="text-red-600">Доступ закрыт</span>
                            @else
                                <form action="{{ route('user.update', $user) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if ($user->isBlocked())
                                        <div>
                                            <button type="submit" class="text-green-700">Разблокировать</button>
                                        </div>
                                        @else
                                        <div>
                                            <button type="submit" class="text-red-600">Заблокировать</button>
                                        </div>
                                    @endif
                                </form>
                            @endif
                        </x-Table.td>
                        <x-Table.td class="">
                        @if (!$user->hasRole('super-admin') || $user->id === Auth::user()->id)
                        <ul class="flex flex-wrap">
                            <li class="mr-3">
                                <a href="{{ route('user.role-show', $user) }}" class="text-blue-400">Роли</a>
                            </li>
                            <li>
                                <a href="{{ route('user.permission-show', $user) }}" class="text-blue-400">Права</a>
                            </li>
                            <li class="w-full">
                                <a href="{{ route('profile.edit', $user) }}" class="text-yellow-400">Редактировать</a>
                            </li>
                            <li class="md:hidden">
                                @if ($user->id === Auth::user()->id)
                                    <div class="hidden"></div>
                                @else
                                    <form action="{{ route('user.update', $user) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        @if ($user->isBlocked())
                                            <div>
                                                <button type="submit" class="text-green-700">Разблокировать</button>
                                            </div>
                                            @else
                                            <div>
                                                <button type="submit" class="text-red-600">Заблокировать</button>
                                            </div>
                                        @endif
                                    </form>
                                @endif
                            </li>
                            <li class="w-full">
                                @can('delete', $user)
                                <form action="{{ route('profile.destroy', $user) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Удалить</button>
                                </form>
                                @endcan
                            </li>
                        </ul>
                        @else
                        <span class="text-red-600">Доступ закрыт</span>
                        @endif
                    </x-Table.td>
                    </x-Table.tr>
                    @endforeach
                </x-Table.tbody>
            </x-Table.index>
        </div>

        <div class="flex justify-end items-center xl:w-2/3 xl:mx-auto my-3">
            <div class="flex justify-center items-center">
                @if ($users->hasPages())
                    @unless ($users->onFirstPage()) 
                        <x-nav-link href="{{ $users->previousPageUrl() }}" class="mr-3">
                            <x-pagination-control-left />
                        </x-nav-link>
                    @endunless

                    {{ $users->currentPage() }} 
                
                    @if ($users->hasMorePages())
                        <x-nav-link href="{{ $users->nextPageUrl() }}" class="ml-3">
                            <x-pagination-control-right />
                        </x-nav-link>
                    @endif
                @endif
            </div>
        </div>
    </div>

</body>
</html>