<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::with('category');

        // Search by name
        if ($term = request('q')) {
            $query = $query->where('name', 'like', "%{$term}%");
        }

        // Filter by category
        if ($categoryId = request('category_id')) {
            $query = $query->where('category_id', $categoryId);
        }

        // Price range
        if (request()->filled('price_min')) {
            $query = $query->where('price', '>=', request('price_min'));
        }
        if (request()->filled('price_max')) {
            $query = $query->where('price', '<=', request('price_max'));
        }

        // Sorting
        if ($sort = request('sort')) {
            if ($sort === 'price_asc') {
                $query = $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query = $query->orderBy('price', 'desc');
            } elseif ($sort === 'new') {
                $query = $query->orderBy('created_at', 'desc');
            }
        } else {
            $query = $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();

        // Provide categories for the filter sidebar
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('client.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // increment view counter
        try {
            $product->increment('views');
        } catch (\Throwable $e) {
            // ignore if DB does not have views column yet
        }

        return view('client.products.show', compact('product'));
    }
}
