<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductList extends Component
{
    /**
     * @var Collection<int, \App\Models\Product>
     */
    public Collection $products;

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-list');
    }
}
