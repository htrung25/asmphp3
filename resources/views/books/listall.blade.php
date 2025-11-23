@extends('books.layout')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Danh Sách Tất Cả Sách</h1>
        <div class="mb-4 text-end">
            <form method="GET" action="{{ route('books.all') }}" class="d-inline">
                <label for="sort" class="me-2 fw-bold">Sắp xếp theo:</label>
                <select name="sort" id="sort" onchange="this.form.submit()" class="form-select d-inline-block w-auto">
                    <option value="newest" {{ $sort ?? 'newest' == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="views" {{ $sort == 'views' ? 'selected' : '' }}>Lượt xem (cao → thấp)</option>
                    <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Giá (thấp → cao)</option>
                    <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Giá (cao → thấp)</option>
                </select>
            </form>
        </div>

        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $book->thumbnail) }}" class="card-img-top" alt="{{ $book->title }}"
                            style="height: 350px; object-fit: cover;">
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
