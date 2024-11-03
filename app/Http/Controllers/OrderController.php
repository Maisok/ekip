<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $carts = $user->carts()->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        foreach ($carts as $cart) {
            $quantity = $request->input('quantity_' . $cart->id, 1);

            Order::create([
                'products_id' => $cart->product->id,
                'user_id' => $user->id,
                'quantity' => $quantity,
            ]);
        }

        $user->carts()->delete();

        return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
    }
}