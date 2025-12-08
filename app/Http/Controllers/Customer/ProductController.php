<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('client.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('client.products.show', compact('product'));
    }
}
