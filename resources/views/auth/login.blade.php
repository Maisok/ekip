<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Side Вход</title>
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center">1
    <x-header/>
    <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50" style="background-image: url('{{asset('img/special-off3 1.png')}}">
        <div class="w-full max-w-md px-8 py-10 bg-gray-800 bg-opacity-90 rounded-xl text-white">
            <div class="text-center mb-6">
                <div class="flex items-center justify-center">
                    <h1 class="text-2xl font-bold mx-2"><span class="text-orange-500">Вход</span></h1>
                </div>
            </div>
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Электронный адрес" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="password" name="password" placeholder="Пароль" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <p class="text-center text-gray-400 text-sm mt-4">
                    <a href="{{ route('register') }}" class="hover:text-orange-500">Создать аккаунт</a>
                </p>
                <button type="submit" class="w-full mt-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md">
                    ПРОДОЛЖИТЬ
                </button>
            </form>
        </div>
    </div>
    <x-footer/>
</body>
</html>