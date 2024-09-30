@extends('books.layout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Trang Chủ</h1>

    <div class="mb-5">
        <h2 class="text-center mb-4">Top 9 Sách Có Lượt Xem Nhiều Nhất</h2>
        <div class="row">
            @foreach ($topViewedBooks as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $book->thumbnail }}" class="card-img-top" alt="Bìa sách">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Tác giả: {{ $book->author }}</p>
                            <small class="text-muted">{{ $book->view_count }} lượt xem</small>
                            <div class="mt-3"> <!-- Thêm div này để căn giữa nút -->
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-5">
        <h2 class="text-center mb-4">Top 9 Sách Mới Nhất</h2>
        <div class="row">
            @foreach ($newestBooks as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $book->thumbnail }}" class="card-img-top" alt="Bìa sách">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Tác giả: {{ $book->author }}</p>
                            <small class="text-muted">Ngày xuất bản: {{ $book->publication}}</small>
                            <div class="mt-3"> <!-- Thêm div này để căn giữa nút -->
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-center">
    </div>
</div>
@endsection
