<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Side</title>
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
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
</head>
<body class="bg-gray-100">
    <div class="wrapper">
        <x-header/>
        <div class="content">
            <section class="relative bg-cover bg-center" style="background-image: url('{{asset("img/istockphoto-483062436-612x612.jpg")}}');">
                <div class="absolute inset-0 bg-black opacity-40"></div>
                <div class="relative z-10 flex flex-col items-center text-center py-20 text-white">
                    <h1 class="text-3xl sm:text-4xl font-bold">СУМКИ И ЧЕХЛЫ</h1>
                    <h2 class="text-4xl sm:text-5xl font-bold mt-2">YUKON OUTFITTERS</h2>
                    <p class="text-lg mt-2">АМЕРИКАНСКОЕ КАЧЕСТВО</p>
                    <a href="#products" class="mt-6 px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-full">
                        КУПИТЬ
                    </a>
                </div>
            </section>

            <section id="products" class="py-16 bg-white">
                <div class="text-center">
                    <img src="{{asset('img/logo2.png')}}" alt="Logo" class="mx-auto w-20">
                    <h3 class="text-lg text-orange-500 font-bold">СПЕЦИАЛЬНЫЕ ПРЕДЛОЖЕНИЯ</h3>
                    <p class="text-gray-700 mt-2">Лучшие цены этого месяца</p>
                </div>

                <div class="grid gap-8 mt-10 px-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($products as $product)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg shadow">
                        <a href="{{route('products.show', $product->id)}}" class="mt-4">{{ $product->name }}</a>
                        <p class="font-bold mt-2">Цена: {{ $product->price }}</p>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
        <x-footer/>
    </div>
</body>
</html>