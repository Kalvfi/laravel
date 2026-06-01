<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Display the product details.
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }
}
