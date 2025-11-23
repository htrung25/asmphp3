{{-- @extends('books.layout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Trang Chủ</h1>

    <div class="mb-5">
        <h2 class="text-center mb-4">Top 8 Sách Có Lượt Xem Nhiều Nhất</h2>
        <div class="row">
            @foreach ($topViewedBooks as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $book->thumbnail) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 350px; object-fit: cover;">
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
        <h2 class="text-center mb-4">Top 8 Sách Mới Nhất</h2>
        <div class="row">
            @foreach ($newestBooks as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $book->thumbnail) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 350px; object-fit: cover;">
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
@endsection --}}
@extends('books.layout')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-5 fw-bold text-primary">Chào Mừng Đến Với Cửa Hàng Sách</h1>

        {{-- Top 4 Sách Bán Chạy Nhất --}}
        <div class="mb-5">
            <h2 class="text-center mb-4 text-danger fw-bold">
                Top 4 Sách Bán Chạy Nhất
            </h2>
            <div class="row">
                @foreach ($bestsellerBooks as $book)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow position-relative border-0">
                            <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger z-3">
                                BÁN CHẠY
                            </span>
                            <img src="{{ asset('storage/' . $book->thumbnail) }}" class="card-img-top"
                                alt="{{ $book->title }}" style="height: 350px; object-fit: cover;">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($book->title, 50) }}</h5>
                                <p class="text-muted small">Tác giả: {{ $book->author }}</p>
                                <p class="text-danger fw-bold fs-5">{{ number_format($book->price) }}₫</p>
                                <small class="text-success">Đã bán: {{ $book->sold_count ?? 0 }} cuốn</small>
                                <div class="mt-auto">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-danger btn-sm mt-3">Xem
                                        Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Top 4 Sách Mới Nhất --}}
        <div class="mb-5">
            <h2 class="text-center mb-4 text-info fw-bold">
                Top 4 Sách Mới Nhất
            </h2>
            <div class="row">
                @foreach ($newestBooks as $book)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow position-relative border-0">
                            <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-info z-3">
                                MỚI
                            </span>
                            <img src="{{ asset('storage/' . $book->thumbnail) }}" class="card-img-top"
                                alt="{{ $book->title }}" style="height: 350px; object-fit: cover;">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($book->title, 50) }}</h5>
                                <p class="text-muted small">Tác giả: {{ $book->author }}</p>
                                <p class="text-success fw-bold fs-5">{{ number_format($book->price) }}₫</p>
                                <p class="text-success fw-bold">{{ number_format($book->price) }}₫</p>
                                <small class="text-danger fw-bold d-block">Đã bán: {{ $book->sold_count ?? 0 }}
                                    cuốn</small>
                                <small class="text-muted">
                                    Ngày: {{ \Carbon\Carbon::parse($book->publication)->format('d/m/Y') }}
                                </small>
                                <div class="mt-auto">
                                    <a href="{{ route('books.show', $book->id) }}"
                                        class="btn btn-info btn-sm mt-3 text-white">Xem Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
