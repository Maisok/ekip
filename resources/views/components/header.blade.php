@vite('resources/css/app.css')
<header class="flex justify-around items-center px-6 py-4 bg-gray-600 text-white">
    <div class="flex items-center space-x-2">
        <div>
            <a href="{{route('home')}}"><img src="{{asset('img/logo.png')}}" alt="Logo" class="w-16 sm:w-40"></a>

        </div>
    </div>

    <nav class="flex space-x-6 text-xs sm:text-lg">
        <a href="{{route('catalog.index')}}" class="hover:text-orange-600 transition-colors">Каталог</a>
        <a href="{{route('cart.index')}}" class="hover:text-orange-600 transition-colors">Корзина</a>

        @if (Auth::check())
        <a href="{{route("profile.show")}}" class="hover:text-orange-600 transition-colors">Личный кабинет</a>
        @if (Auth::user()->isAdmin())
        <div>
          <a href="{{route('products.create')}}" class="hover:text-orange-600 transition-colors">Админ панель</a>
        </div>
        @endif
        @else
        <a href="{{route('register')}}" class="hover:text-orange-600 transition-colors">Личный кабинет</a>
        @endif
    </nav>
</header>