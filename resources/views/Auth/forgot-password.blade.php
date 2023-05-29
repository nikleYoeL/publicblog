<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <title>Забыли пароль</title>
</head>
<body class="flex min-h-screen justify-center content-center bg-neutral-200">
    <x-Form.form action="{{ route('password.email') }}" class="w-full md:w-2/5 xl:w-1/5 md:my-auto">
        @if (session('status'))
        <div class="mb-3 px-2 py-1.5 text-green-700 bg-green-500/20">{{ session('status') }}</div>
        @endif

        <div class="flex flex-col">
            <x-Form.label for="email">Почта</x-Form.label>
            @if ($errors->has('email'))
                <ul class="text-red-500 text-sm">
                    @foreach ($errors->get('email') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <x-Form.input type="email" id="email" name="email" value="{{ old('email')}}" />
        </div>
        <x-Form.submit>Отправить ссылку для сброса пароля</x-Form.submit>
    </x-Form.form>
</body>
</html>