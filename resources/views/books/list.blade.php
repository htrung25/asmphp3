@extends('books.layout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Danh Sách Sách: {{ $category->name }}</h1>

    <div class="mb-4">
        <h3 class="text-center mb-4">Danh Mục Sách</h3>
        <div class="d-flex justify-content-center mb-3">
            @foreach ($categories as $cat)
                <a href="{{ route('books.list', $cat->id) }}" class="btn btn-outline-primary mx-2 {{ $cat->id == $category->id ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $book->thumbnail) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 350px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Tác giả: {{ $book->author }}</p>
                        <small class="text-muted">Lượt xem: {{ $book->view_count }}</small><br>
                        <small class="text-muted">Ngày xuất bản: {{ $book->publication }}</small>
                        <div class="mt-3"> 
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center">
        <a href="{{ route('books.list', 1) }}" class="btn btn-primary">Xem Tất Cả Sách</a>
    </div>
</div>
@endsection
