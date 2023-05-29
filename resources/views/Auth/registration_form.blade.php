<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <title>Регистрация</title>
</head>
<body class="flex min-h-screen justify-center content-center bg-slate-100">
    <x-Form.form action="{{ route('registration.store') }}" class="w-full md:w-2/5 xl:w-1/5 md:my-auto">
        <x-Form.label for="name">Имя</x-Form.label>
        @if ($errors->has('name'))
            <ul class="text-sm text-red-500">
                @foreach ($errors->get('name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.input type="text" id="name" name="name" value="{{ old('name')}}" />

        <x-Form.label for="email">Почта</x-Form.label>
        @if ($errors->has('email'))
            <ul class="text-sm text-red-500">
                @foreach ($errors->get('email') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.input type="email" id="email" name="email" value="{{ old('email')}}" />

        <x-Form.label for="pass">Пароль</x-Form.label>
        @if ($errors->has('password'))
            <ul class="text-sm text-red-500">
                @foreach ($errors->get('password') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.input type="password" id="pass" name="password" />

        <x-Form.label for="pass_confirm">Повторите пароль</x-Form.label>
        <x-Form.input type="password" id="pass_confirm" name="password_confirmation" />

        <x-Form.submit type="submit">Регистрация</x-Form.submit>

        <div class="flex flex-row justify-center items-center">
            <span class="text-xs">Есть аккаунт?</span>
            <a href="{{ route('login') }}" class="text-gray-400 text-sm ml-2">Войти</a>
        </div>
    </x-Form.form>
</body>
</html>