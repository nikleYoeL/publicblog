<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @vite('resources/css/app.css')

    <title>Вход</title>
</head>
<body class="flex min-h-screen justify-center content-center bg-neutral-200">
    <x-Form.form action="{{ route('login.store') }}" class="w-full md:w-2/5 xl:w-1/5 md:my-auto">
        @if (session('status'))
        <div class="mb-3 px-2 py-1.5 text-green-700 bg-green-500/20">{{ session('status') }}</div>
        @endif

        <div class="flex flex-col p-3">
            <x-Form.label for="email">Почта</x-Form.label>
            @if ($errors->has('email'))
                <ul class="text-sm text-red-500">
                    @foreach ($errors->get('email') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <x-Form.input type="email" id="email" name="email" value="{{ old('email')}}"></x-Form.input>
            
            <x-Form.label for="password">Пароль</x-Form.label>
            @if ($errors->has('password'))
                <ul class="text-sm text-red-500">
                    @foreach ($errors->get('password') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <x-Form.input type="password" id="password" name="password" />

            <div class="flex flex-row justify-between items-end">
                <div class="flex flex-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="ml-1 text-xs">Запомнить меня</label>
                </div>
                <div class="flex flex-col">
                    <x-secondary-nav-link href="{{ route('registration.create') }}" class="hover:text-sky-900">Регистрация</x-secondary-nav-link>
                    <x-secondary-nav-link href="{{ route('password.request') }}" class="hover:text-sky-900">Забыли пароль?</x-secondary-nav-link>
                </div>
            </div>

            <x-Form.submit>Войти</x-Form.submit>
        </div>
    </x-Form.form>
</body>
</html>