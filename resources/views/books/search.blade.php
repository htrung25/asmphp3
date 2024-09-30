@extends('books.layout')

@section('content')
<div class="container">
    <h1>Kết quả tìm kiếm cho: "{{ $query }}"</h1>
    @if($books->isEmpty())
        <p>Không tìm thấy kết quả nào.</p>
    @else
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ $book->thumbnail }}" alt="Thumbnail" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->author }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
