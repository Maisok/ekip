<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
    <title>Wild Side Регистрация</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        footer {
            background-color: #1a202c;
            color: white;
            padding: 1rem;
            text-align: center;
            width: 100%;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center">
    <x-header/>
    <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50" style="background-image: url('{{asset('img/special-off3 1.png')}}">
        <div class="w-full max-w-md px-8 py-10 bg-gray-800 bg-opacity-90 rounded-xl text-white">
            <div class="text-center mb-6">
                <div class="flex items-center justify-center">
                    <h1 class="text-2xl font-bold mx-2"><span class="text-orange-500">Регистрация</span></h1>
                </div>
            </div>
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Имя" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <input type="text" maxlength="16" id="phone_number" name="phone_number" placeholder="Номер телефона" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                @error('phone_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <input type="password" name="password" placeholder="Пароль" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <input type="password" name="password_confirmation" placeholder="Подтверждение пароля" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <input type="email" name="email" placeholder="Электронный адрес" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="g-recaptcha" data-sitekey="6Lc9BYEqAAAAAIeUpt8pHeRh9FoKB9t5DLmsMxdu"></div>
                @error('g-recaptcha-response')
                    <p class="text-red-500 text-xs mt-1">Пожалуйста, подтвердите, что вы не робот.</p>
                @enderror

                <p class="text-center text-gray-400 text-sm mt-4">
                    <a href="{{ route('login') }}" class="hover:text-orange-500">Войти в существующий аккаунт</a>
                </p>
                <button type="submit" class="w-full mt-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md">
                    ПРОДОЛЖИТЬ
                </button>
            </form>
        </div>
    </div>
    <x-footer/>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneInput = document.getElementById('phone_number');
      
            phoneInput.addEventListener('input', function (e) {
                let phoneNumber = e.target.value.replace(/\D/g, ''); // Удаляем все нецифровые символы
                if (phoneNumber.length > 0) {
                    phoneNumber = '8 ' + phoneNumber.substring(1); // Добавляем префикс "8 "
                }
                if (phoneNumber.length > 2) {
                    phoneNumber = phoneNumber.substring(0, 2) + ' ' + phoneNumber.substring(2);
                }
                if (phoneNumber.length > 6) {
                    phoneNumber = phoneNumber.substring(0, 6) + ' ' + phoneNumber.substring(6);
                }
                if (phoneNumber.length > 10) {
                    phoneNumber = phoneNumber.substring(0, 10) + ' ' + phoneNumber.substring(10);
                }
                if (phoneNumber.length > 13) {
                    phoneNumber = phoneNumber.substring(0, 13) + ' ' + phoneNumber.substring(13);
                }
                e.target.value = phoneNumber;
            });
        });
    </script>
</body>
</html>