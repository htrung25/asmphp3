<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Show cart contents
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    // Add product to cart
    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'nullable|integer|min:1',
            'redirect_to' => 'nullable|string',
        ]);

        $product = Product::findOrFail($data['product_id']);
        $qty = isset($data['qty']) ? (int)$data['qty'] : 1;

        // Cap by stock
        if ($product->stock < $qty) {
            $qty = $product->stock;
        }

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['qty'] + $qty;
            $cart[$product->id]['qty'] = min($newQty, $product->stock);
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'image_url' => $product->image_url,
                'description' => $product->description,
            ];
        }

        $request->session()->put('cart', $cart);

        // If redirect_to == cart, go to cart page
        // prepare count for response
        $count = array_sum(array_column($cart, 'qty'));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => 'Đã thêm vào giỏ hàng',
            ]);
        }

        if (!empty($data['redirect_to']) && $data['redirect_to'] === 'cart') {
            return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng');
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    // Update quantity
    public function update(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($data['product_id']);
        $qty = min($data['qty'], $product->stock);

        $cart = $request->session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = $qty;
            $request->session()->put('cart', $cart);
        }

        return back()->with('success', 'Cập nhật giỏ hàng thành công');
    }

    // Remove item
    public function remove(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $request->session()->put('cart', $cart);
        }
        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // Clear cart
    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Đã xóa giỏ hàng');
    }

    // Dummy checkout: clear cart and redirect
    public function checkout(Request $request)
    {
        // In real app create order, reduce stock, etc.
        $request->session()->forget('cart');
        return redirect()->route('home')->with('success', 'Thanh toán giả lập thành công, cảm ơn bạn!');
    }
}
