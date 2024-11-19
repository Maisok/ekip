<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля</title>
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center">
    <x-header/>
    <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50" style="background-image: url('{{asset('img/special-off3 1.png')}}">
        <div class="w-full max-w-md px-8 py-10 bg-gray-800 bg-opacity-90 rounded-xl text-white">
            <div class="text-center mb-6">
                <div class="flex items-center justify-center">
                    <h1 class="text-2xl font-bold mx-2"><span class="text-orange-500">Редактирование профиля</span></h1>
                </div>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="text" name="name" placeholder="Имя" value="{{ $user->name }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="text" id="phone_number" name="phone_number" placeholder="Номер телефона" value="{{ $user->phone_number }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                @error('phone_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <input type="email" name="email" placeholder="Электронный адрес" value="{{ $user->email }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="password" name="password" placeholder="Новый пароль" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="password" name="password_confirmation" placeholder="Подтверждение нового пароля" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <button type="submit" class="w-full mt-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md">
                    СОХРАНИТЬ
                </button>
            </form>
        </div>
    </div>
    <x-footer/>

    <script>
        document.getElementById('phone_number').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, '').substring(0, 11); // Удаляем все нецифровые символы и ограничиваем длину до 11 цифр
            let size = input.length;

            if (size > 0) {
                input = '8 ' + input.substring(1); // Добавляем "8 " в начале
            }
            if (size > 4) {
                input = input.slice(0, 2) + input.slice(2, 5) + ' ' + input.slice(5);
            }
            if (size > 7) {
                input = input.slice(0, 8) + ' ' + input.slice(8, 11) + ' ' + input.slice(11);
            }
            if (size > 9) {
                input = input.slice(0, 13) + ' ' + input.slice(13, 15) + ' ' + input.slice(15);
            }

            e.target.value = input;
        });
    </script>
</body>
</html>