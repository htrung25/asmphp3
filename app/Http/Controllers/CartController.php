<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session('cart', []);
        return view('books.cart', compact('cart'));
    }

    // Thêm sách vào giỏ
    public function add(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$id] = [
                'title' => $book->title,
                'author' => $book->author,
                'thumbnail' => $book->thumbnail,
                'price' => $book->price,
                'quantity' => $request->quantity ?? 1
            ];
        }

        // Tăng sold_count khi thêm vào giỏ (giả lập bán hàng)
        $book->increment('sold_count', $request->quantity ?? 1);

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Xóa sản phẩm
    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Đã xóa khỏi giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request)
    {
        $cart = session('cart', []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }
        return back()->with('success', 'Cập nhật số lượng thành công!');
    }

    // Xóa toàn bộ giỏ
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Đã làm trống giỏ hàng!');
    }
}