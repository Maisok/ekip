<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center">
    <x-header/>
    <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50" style="background-image: url('{{asset('img/special-off3 1.png')}}">
        <div class="w-full max-w-4xl px-8 py-10 bg-gray-800 bg-opacity-90 rounded-xl text-white flex flex-col md:flex-row">
            <!-- Левая часть: Данные пользователя -->
            <div class="w-full md:w-1/2 pr-8">
                <div class="text-center mb-6">
                    <div class="flex items-center justify-center">
                        <h1 class="text-2xl font-bold mx-2"><span class="text-orange-500">Личный кабинет</span></h1>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="font-semibold">Имя:</span>
                        <span>{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Email:</span>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Номер телефона:</span>
                        <span>{{ $user->phone_number }}</span>
                    </div>
                    

                    <div class="flex justify-center">
                        <a href="{{route('profile.edit')}}" class="w-full py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md">
                            Редактировать данные
                        </a>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-md">
                            Выйти
                        </button>
                    </form>
                </div>
            </div>

            <!-- Правая часть: Заказы пользователя -->
            <div class="w-full md:w-1/2 pl-8 border-t md:border-t-0 md:border-l border-gray-700 mt-6 md:mt-0">
                <h2 class="text-xl font-bold mb-4">Ваши заказы</h2>
                @if($orders->isEmpty())
                    <p>У вас пока нет заказов.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($orders as $order)
                            <li class="border-b border-gray-700 pb-4">
                                <div class="flex justify-between">
                                    <span class="font-semibold">ID заказа:</span>
                                    <span>{{ $order->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Количество:</span>
                                    <span>{{ $order->quantity }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Дата создания:</span>
                                    <span>{{ $order->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <!-- Вывод картинки товара -->
                                @if($order->product)
                                    <div class="mt-4">
                                        <span class="font-semibold">Товар:</span>
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/'. $order->product->image) }}" alt="{{ $order->product->name }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                            <span>{{ $order->product->name }}</span>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <x-footer/>
</body>
</html>