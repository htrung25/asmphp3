<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $topViewedBooks = Book::orderBy('view_count', 'desc')->take(9)->get();
        $newestBooks = Book::orderBy('publication', 'desc')->take(9)->get();
        $categories = Category::all(); // Lấy tất cả các danh mục sách

        return view('books.index', compact('topViewedBooks', 'newestBooks', 'categories'));
    }

    public function showAll()
    {
        $books = Book::paginate(10);
        return view('books.listall', compact('books'));
    }


    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function listByCategory($id = 1) // Mặc định category_id là 1
    {
        $books = Book::where('category_id', $id)->get();
        $categories = Category::all(); // Lấy tất cả các danh mục
        $category = Category::find($id); // Lấy thông tin danh mục hiện tại
        return view('books.list', compact('books', 'category', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');


        $books = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->get();


        if ($books->isEmpty()) {
            $similarBooks = Book::where('title', 'LIKE', "%{$query}%")
                ->orWhere('author', 'LIKE', "%{$query}%")
                ->get();
            $books = $similarBooks->isEmpty() ? Book::all() : $similarBooks;
        }

        return view('books.search', compact('books', 'query'));
    }
}
