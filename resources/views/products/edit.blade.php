<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование товара</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center">
    <x-header/>
    <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50" style="background-image: url('{{asset('img/special-off3 1.png')}}">
        <div class="w-full max-w-md px-8 py-10 bg-gray-800 bg-opacity-90 rounded-xl text-white">
            <div class="text-center mb-6">
                <div class="flex items-center justify-center">
                    <h1 class="text-2xl font-bold mx-2"><span class="text-orange-500">Редактирование товара</span></h1>
                </div>
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="text" name="article" placeholder="Артикул" value="{{ $product->article }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="text" name="name" placeholder="Название" value="{{ $product->name }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <textarea name="description" placeholder="Описание" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $product->description }}</textarea>
                <input type="text" name="color" placeholder="Цвет" value="{{ $product->color }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <select name="season" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="зима" {{ $product->season == 'зима' ? 'selected' : '' }}>Зима</option>
                    <option value="лето" {{ $product->season == 'лето' ? 'selected' : '' }}>Лето</option>
                    <option value="осень" {{ $product->season == 'осень' ? 'selected' : '' }}>Осень</option>
                    <option value="весна" {{ $product->season == 'весна' ? 'selected' : '' }}>Весна</option>
                </select>
                <input type="number" name="price" placeholder="Цена" value="{{ $product->price }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="text" name="sizes" placeholder="Размеры" value="{{ $product->sizes }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="text" name="material" placeholder="Материал" value="{{ $product->material }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="text" name="brand" placeholder="Бренд" value="{{ $product->brand }}" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="file" name="image" class="w-full px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <button type="submit" class="w-full mt-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md">
                    СОХРАНИТЬ
                </button>
            </form>
        </div>
    </div>
    <x-footer/>
</body>
</html>