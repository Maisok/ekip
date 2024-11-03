<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Side Корзина</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <h1 class="text-2xl font-bold mx-2"><span class="text-orange-500">Корзина</span></h1>
                </div>
                @if($carts->isEmpty())
                    <div class="text-center text-gray-700">
                        <p>Корзина пуста.</p>
                    </div>
                @else
                    <form action="{{ route('order.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="grid gap-8 mt-10 px-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                            @foreach($carts as $cart)
                            <div class="text-center" id="cart-item-{{ $cart->id }}">
                                <img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="w-full h-48 object-cover rounded-lg shadow">
                                <p class="mt-4">{{ $cart->product->name }}</p>
                                <p class="font-bold mt-2" data-price-id="{{ $cart->id }}">Цена: {{ $cart->product->price }}</p>
                                <div class="mt-4">
                                    <label for="quantity_{{ $cart->id }}" class="text-gray-700">Количество:</label>
                                    <input type="number" name="quantity_{{ $cart->id }}" id="quantity_{{ $cart->id }}" value="1" min="1" max="100" class="px-4 py-2 bg-gray-700 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500" onchange="validateQuantity(this)">
                                </div>
                                <button type="button" class="mt-4 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-md" onclick="removeCartItem({{ $cart->id }})">
                                    Удалить из корзины
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-8">
                            <p class="text-lg font-bold" id="total-price">Общая сумма: {{ $carts->sum(function($cart) { return $cart->product->price; }) }}</p>
                            <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-md">
                                Оформить заказ
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
        <x-footer/>
    </div>

    <script>
        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('input[name^="quantity_"]').forEach(input => {
                const cartId = input.id.split('_')[1];
                const priceElement = document.querySelector(`p[data-price-id="${cartId}"]`);
                if (priceElement) {
                    const price = parseFloat(priceElement.textContent.split(': ')[1]);
                    const quantity = parseInt(input.value);
                    totalPrice += price * quantity;
                }
            });
            document.getElementById('total-price').textContent = `Общая сумма: ${totalPrice}`;
        }

        function validateQuantity(input) {
            const min = parseInt(input.min);
            const max = parseInt(input.max);
            const value = parseInt(input.value);

            if (value < min) {
                input.value = min;
            } else if (value > max) {
                input.value = max;
            }

            updateTotalPrice();
        }

        function removeCartItem(cartId) {
            fetch(`/cart/delele/${cartId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById(`cart-item-${cartId}`).remove();
                    updateTotalPrice();
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }

        document.querySelectorAll('input[name^="quantity_"]').forEach(input => {
            input.addEventListener('input', () => validateQuantity(input));
        });
    </script>
</body>
</html>