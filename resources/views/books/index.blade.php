@extends('books.layout')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4 fw-bold text-primary">Chào Mừng Đến Với Cửa Hàng Sách</h1>

                {{-- Hero / Banner --}}
                <div class="hero-banner mb-4 p-4 rounded-3">
                        <div class="row align-items-center">
                                <div class="col-md-8 text-center text-md-start">
                                        <h2 class="fw-bold mb-2">Khám Phá Những Cuốn Sách Tuyệt Vời</h2>
                                        <p class="mb-3">Ưu đãi đặc biệt, sách bán chạy và sách mới cập nhật mỗi tuần. Tìm sách phù hợp với bạn ngay hôm nay.</p>
                                        <a href="#products" class="btn btn-light btn-sm">Mua Ngay</a>
                                </div>
                        </div>
                </div>

        {{-- Carousel (Bootstrap 5) --}}    
                <div id="homepageCarousel" class="carousel slide mb-4 rounded-3" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-indicators">
                                <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                                <div class="carousel-item active">
                                        <img src="{{ asset('images/carousel1.jpg') }}" class="d-block w-100" alt="Banner 1" style="height:420px; object-fit:cover;">
                                        <div class="carousel-caption d-none d-md-block text-start">
                                                <h5 class="fw-bold">Khám Phá Những Cuốn Sách Tuyệt Vời</h5>
                                                <p>Ưu đãi đặc biệt, sách bán chạy và sách mới cập nhật mỗi tuần.</p>
                                        </div>
                                </div>
                                <div class="carousel-item">
                                        <img src="{{ asset('images/carousel2.jpg') }}" class="d-block w-100" alt="Banner 2" style="height:420px; object-fit:cover;">
                                        <div class="carousel-caption d-none d-md-block text-start">
                                                <h5 class="fw-bold">Sách Bán Chạy</h5>
                                                <p>Những cuốn sách được yêu thích nhất bởi độc giả.</p>
                                        </div>
                                </div>
                                <div class="carousel-item">
                                        <img src="{{ asset('images/carousel3.jpg') }}" class="d-block w-100" alt="Banner 3" style="height:420px; object-fit:cover;">
                                        <div class="carousel-caption d-none d-md-block text-start">
                                                <h5 class="fw-bold">Mới Ra Mắt</h5>
                                                <p>Cập nhật sách mới, ưu đãi hấp dẫn mỗi tuần.</p>
                                        </div>
                                </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                        </button>
                </div>

        {{-- Top 4 Sách Bán Chạy Nhất --}}
        <div class="mb-5" id="products">
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
