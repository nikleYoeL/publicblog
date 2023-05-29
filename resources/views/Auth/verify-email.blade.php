<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Подтверждение почты</title>
</head>
<body class="bg-neutral-200">
    <x-header.layout>
        <x-header.nav />
        <x-header.search />
        <x-header.login />
    </x-header.layout>

    <div class="flex justify-center content-center">
        <x-Form.form action="{{ route('verification.send') }}" class="w-full sm:w-2/5 xl:w-1/5 md:my-auto">
            <p class="mx-auto mb-3">Чтобы получить доступ к этому разделу, Вам необходимо подтвердить свой email адрес!</p>
            <x-Form.submit>Отправить ссылку для подтверждения</x-Form.submit>
        </x-Form.form>
    </div>
</body>
</html>