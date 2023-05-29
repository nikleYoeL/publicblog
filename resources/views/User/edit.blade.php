<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <title>Редактирование профиля</title>
</head>
<body class="flex min-h-screen justify-center content-center bg-neutral-200">
    <x-Form.form action="{{ route('profile.update', $user) }}" enctype="multipart/form-data" class="w-full sm:w-2/3 xl:w-1/3 md:my-auto">
        @method('PUT')

        <x-Form.label for="avatar">Фото профиля</x-Form.label>
        @if($errors->has('avatar'))
            <ul class="text-red-500 text-sm">
                @foreach ($errors->get('avatar') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <input type="file" name="avatar" id="avatar" class="mb-3">

        <x-Form.label for="name">Имя</x-Form.label>
        @if ($errors->has('name'))
            <ul class="text-red-500 text-sm">
                @foreach ($errors->get('name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.input type="text" id="name" name="name" value="{{ old('name') ?? $user->name }}" />

        <x-Form.label for="email">Почта</x-Form.label>
        @if ($errors->has('email'))
            <ul class="text-red-500 text-sm">
                @foreach ($errors->get('email') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.input type="email" id="email" name="email" value="{{  $user->email  }}" />

        <x-Form.label for="bio">О себе</x-Form.label>
        @if ($errors->has('bio'))
            <ul class="text-red-500 text-sm">
                @foreach ($errors->get('bio') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <x-Form.textarea id="bio" name="bio">{!! $user->bio !!}</x-Form.textarea>

        <x-Form.submit type="submit">Обновить</x-Form.submit>
    </x-Form.form>
</body>
</html>