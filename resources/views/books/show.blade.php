@extends('books.layout')

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="{{ $book->title }}" class="img-fluid">
        </div>
        <div class="col-md-8">
            <p><strong>Tác giả:</strong> {{ $book->author }}</p>
            <p><strong>Nhà xuất bản:</strong> {{ $book->publisher }}</p>
            <p><strong>Ngày xuất bản:</strong> {{ $book->publication }}</p>
            <p><strong>Giá bán:</strong> {{ $book->price }} VND</p>
            <p><strong>Số lượng:</strong> {{ $book->quantity }}</p>
            <p><strong>Lượt xem:</strong> {{ $book->view_count }}</p>
        </div>
    </div>
</div>
@endsection
