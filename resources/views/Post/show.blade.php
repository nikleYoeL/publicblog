<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>{{ $post->title }}</title>
</head>
<body class="flex flex-col min-h-screen">
    <x-header.layout>
        <x-header.nav />
        <x-header.search />
        <x-header.login />
    </x-header.layout>

    <div class="container mx-auto flex flex-col">
        <x-statusbar />

        <x-Post.article>
            <x-Post.header>
                <x-Post.header-up  :post="$post">
                    <x-Post.manage-post :post="$post" />
                </x-Post.header-up>
                <x-Post.header-down :post="$post" />
            </x-Post.header>
            <x-Post.body :post="$post" class="py-3"/>
        </x-Post.article>
        
        <ul class="flex flex-col w-full px-2 xl:w-3/5 xl:mx-auto lg:px-0">
            
            <strong>Комментарии:</strong>
            
            @foreach ($post->comments as $comment)
                <li class="flex flex-row mb-1.5 last:mb-0 px-3 py-1 bg-gray-100">
                    <div class="w-12 h-12 mr-3">
                        <img src="{{ asset('storage/' . $comment->user->avatar) }}" width="100%" height="100%" alt="Фото профиля">
                    </div>
                    
                    <div class="flex flex-row flex-wrap justify-between w-full">
                        <strong class="basis-5/12 shrink">
                            <x-nav-link href="{{ route('profile.show', $comment->user) }}">{{ $comment->user->name }}</x-nav-link>
                        </strong>

                        <div class="flex flex-row items-center">
                            <span class="text-sm text-neutral-400">{{ $comment->parseInCarbon('created_at')->diffForHumans() }}</span>
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" method="post" class="self-end">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="h-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-4 h-4 stroke-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            @endcan
                        </div>

                        <p class="basis-full shrink leading-none">{!! nl2br($comment->message) !!}</p>
                    </div>
                </li>                
            @endforeach
        </ul>
        <div class="w-3/4 lg:w-1/2 mx-auto my-2">
                @auth
                    @if(!(Auth::user()->isBlocked()) && Auth::user()->can('write comment'))    
                        <x-Form.form action="{{ route('post.comments.store', $post->id) }}">
                            <x-Form.textarea name="message" placeholder="Текст комментария"></x-Form.textarea>
                            <x-Form.submit>Комментировать</x-Form.submit>
                        </x-Form.form>
                    @else
                        <span class="text-sm text-red-500">Вы не можете добавить комментарий, так как Вы заблокированы</span>
                    @endif
                @endauth
                @guest
                    <div class="flex flex-row justify-center items-center">
                        <a href="{{ route('login') }}" class="text-gray-400 text-sm underline mr-1">Войдите</a>
                        <span class="text-sm">чтобы оставить комментарий</span>
                    </div>
                @endguest
        </div>
    </div>
</body>
</html>