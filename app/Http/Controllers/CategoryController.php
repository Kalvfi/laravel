<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function show(Category $category)
    {
        $products = $category->products;

        return view('categories.show', [
            'category' => $category,
            'products' => $products
        ]);
    }
}
