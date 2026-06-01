<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $category->load(['products', 'children.products']);

        $products = $category->products->merge($category->children->flatMap->products);

        return view('categories.show', compact('category', 'products'));
    }
}
