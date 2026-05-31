<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CategoryTree extends Component
{
    /**
     * @var Collection<int, \App\Models\Category>
     */
    public Collection $categories;

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-tree');
    }
}
