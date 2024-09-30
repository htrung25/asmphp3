@extends('books.layout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Danh Sách Tất Cả Sách</h1>

    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $book->thumbnail }}" class="card-img-top" alt="Bìa sách">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Tác giả: {{ $book->author }}</p>
                        <small class="text-muted">Ngày xuất bản: {{ $book->publication }}</small>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary mt-2">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- Nút Previous -->
                <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>

                <!-- Các trang -->
                @for ($i = 1; $i <= $books->lastPage(); $i++)
                    <li class="page-item {{ $i == $books->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <!-- Nút Next -->
                <li class="page-item {{ $books->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
