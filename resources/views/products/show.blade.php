<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Wild Side</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <x-header/>
    <div class="container mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow">
            </div>
            <div>
                <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
                <p class="text-gray-700 mt-4">{{ $product->description }}</p>
                <p class="text-lg font-bold mt-4">Цена: {{ $product->price }}</p>
                <p class="text-gray-700 mt-4">Артикул:{{ $product->article }}</p>
                <p class="text-gray-700 mt-2">Цвет: {{ $product->color }}</p>
                <p class="text-gray-700 mt-2">Сезон: {{ $product->season }}</p>
                <p class="text-gray-700 mt-2">Размеры: {{ $product->sizes }}</p>
                <p class="text-gray-700 mt-2">Материал: {{ $product->material }}</p>
                <p class="text-gray-700 mt-2">Бренд: {{ $product->brand }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-md">
                        Добавить в корзину
                    </button>
                </form>
            </div>
        </div>
    </div>
    <x-footer/>
</body>
</html>