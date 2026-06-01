<?php

namespace App\View\Components;

use App\Models\CartItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartItemQuantity extends Component
{
    public CartItem $cartItem;

    /**
     * Create a new component instance.
     */
    public function __construct(CartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-item-quantity', [
            'cartItem' => $this->cartItem
        ]);
    }
}
