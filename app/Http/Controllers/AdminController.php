<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        $categories = Category::with('parent')->where('id', '!=', 1)->get();

        return view('admin.index', compact('products', 'categories'));
    }
}
