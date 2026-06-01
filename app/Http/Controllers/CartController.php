<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cart = Cart::with('cartItems.product')->where('user_id', Auth::user()->id)->first();
        $total = $cart ? $cart->cartItems->sum(fn($item) => $item->product->price * $item->quantity) : 0;

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1']
        ]);

        $quantityToAdd = $validated['quantity'] ?? 1;

        $cart = Cart::firstOrCreate(['user_id' => Auth::user()->id]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantityToAdd);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity' => $quantityToAdd
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1']
        ]);

        $quantityToRemove = $validated['quantity'] ?? 1;
        $cart = Cart::where('user_id', Auth::user()->id)->first();

        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $validated['product_id'])
                ->first();

            if ($cartItem) {
                if ($cartItem->quantity > $quantityToRemove) {
                    $cartItem->decrement('quantity', $quantityToRemove);
                    $message = 'Cart updated!';
                } else {
                    $cartItem->delete();
                    $message = 'Item removed from cart!';
                }
            }
        }

        return redirect()->back()->with('success', $message ?? 'Cart updated!');
    }

    public function checkout(Request $request)
    {
        $cart = Cart::with('cartItems.product')->where('user_id', Auth::user()->id)->first();

        if ($cart && $cart->cartItems->isNotEmpty()) {

            DB::transaction(function () use ($cart) {

                foreach ($cart->cartItems as $item) {
                    if ($item->product) {
                        if ($item->quantity > $item->product->stock) {
                            $item->product->decrement('stock', $item->product->stock);
                        } else {
                            $item->product->decrement('stock', $item->quantity);
                        }
                    }
                }

                $cart->cartItems()->delete();
            });
        }

        return redirect()->route('cart.index')->with('success', 'Checkout successful! Your cart has been cleared.');
    }
}
