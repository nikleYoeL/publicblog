<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @vite('resources/css/app.css')

    <title>Сброс пароля</title>
</head>
<body class="flex min-h-screen justify-center content-center bg-neutral-200">
    <x-Form.form action="{{ route('password.update') }}" class="w-full md:w-2/5 xl:w-1/5 md:my-auto">
        <div class="flex flex-col p-3">
            <x-Form.input type="hidden" name="token" value="{{ $token }}" />

            <x-Form.label for="email">Почта</x-Form.label>
            @if ($errors->has('email'))
                <ul class="text-sm text-red-500">
                    @foreach ($errors->get('email') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <x-Form.input type="email" id="email" name="email" value="{{ old('email', request()->email) }}" />
            
            <x-Form.label for="password">Пароль</x-Form.label>
            @if ($errors->has('password'))
                <ul class="text-sm text-red-500">
                    @foreach ($errors->get('password') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <x-Form.input type="password" id="password" name="password" />

            <x-Form.label for="pass_confirm">Повторите пароль</x-Form.label>
            <x-Form.input type="password" id="pass_confirm" name="password_confirmation" />

            <x-Form.submit>Обновить пароль</x-Form.submit>
        </div>
    </x-Form.form>
</body>
</html>