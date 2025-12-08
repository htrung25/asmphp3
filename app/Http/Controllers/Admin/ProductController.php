<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! $user->hasRole('admin')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Handle uploaded image file if provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            // Storage::url returns '/storage/...' by default for the public disk
            $data['image_url'] = Storage::url($path);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // If a new image file is uploaded, store it and remove old file if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_url'] = Storage::url($path);

            // attempt to delete old image file if it was stored in /storage
            $old = $product->image_url;
            if ($old) {
                // normalize and remove leading slash
                $oldPath = preg_replace('#^/storage/#', '', $old);
                $oldPath = preg_replace('#^storage/#', '', $oldPath);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Xóa sản phẩm thành công!');
    }
}
