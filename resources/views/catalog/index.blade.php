<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Side Каталог товаров</title>
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
            <div class="container mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold mx-2"><span class="text-orange-500">Каталог товаров</span></h1>
                </div>
                <form action="{{ route('catalog.index') }}" method="GET" class="mb-8">
                    <div class="flex flex-wrap justify-center space-x-4">
                        <div>
                            <label for="season" class="text-gray-700">Сезон:</label>
                            <select name="season" id="season" class="px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="">Все</option>
                                <option value="зима">Зима</option>
                                <option value="лето">Лето</option>
                                <option value="осень">Осень</option>
                                <option value="весна">Весна</option>
                            </select>
                        </div>
                        <div>
                            <label for="min_price" class="text-gray-700">Минимальная цена:</label>
                            <input type="number" name="min_price" id="min_price" class="px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label for="max_price" class="text-gray-700">Максимальная цена:</label>
                            <input type="number" name="max_price" id="max_price" class="px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md">
                            Применить фильтры
                        </button>
                    </div>
                </form>
                @if($products->isEmpty())
                    <div class="text-center text-gray-700">
                        <p>Товаров не найдено.</p>
                    </div>
                @else
                    <div class="grid gap-8 mt-10 px-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($products as $product)
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg shadow">
                            <a href="{{route('products.show', $product->id)}}" class="mt-4">{{ $product->name }}</a>
                            <p class="font-bold mt-2">Цена: {{ $product->price }}</p>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <x-footer/>
    </div>
</body>
</html>