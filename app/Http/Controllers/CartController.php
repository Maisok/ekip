<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carts = $user->carts()->with('product')->get();
        return view('cart.index', compact('carts'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            return redirect()->back()->with('error', 'Product is already in the cart.');
        }

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json(['success' => true]);
    }
}
