@extends('client.layouts.app')

@section('title', 'Trang chủ - Gundam Shop')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Left: categories column -->
        <aside class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-danger text-white">Danh mục sản phẩm</div>
                <ul class="list-group list-group-flush">
                    @forelse($categories as $cat)
                        <li class="list-group-item">
                            <a href="{{ route('products.index', ['category_id' => $cat->id]) }}" class="text-decoration-none">{{ $cat->name }}</a>
                        </li>
                    @empty
                        <li class="list-group-item">Chưa có danh mục</li>
                    @endforelse
                </ul>
            </div>
        </aside>

        <!-- Right: main content -->
        <section class="col-md-9">
            <div class="mb-4">
                <div class="card">
                    <div class="card-body text-center bg-dark text-white">
                        <h1 class="display-5 fw-bold mb-2">CHÀO MỪNG ĐẾN VỚI GUNDAM SHOP</h1>
                        <p class="lead">Bộ sưu tập Gundam chính hãng lớn nhất Việt Nam</p>
                        <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg mt-2">XEM NGAY</a>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="mb-3">Sản phẩm hot nhất</h4>
                <div class="row g-3 mb-4">
                    @forelse($hotProducts as $product)
                        <div class="col-md-4">
                            <div class="card h-100">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</h6>
                                    <p class="text-muted mb-2 small">{{ $product->category ? $product->category->name : '' }}</p>
                                    <p class="fw-bold text-danger mb-2">₫{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="mt-auto d-flex gap-2">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                        <form action="{{ route('cart.add') }}" method="POST" class="m-0 ajax-add-cart" data-redirect="">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="qty" value="1">
                                            <button class="btn btn-sm btn-success">Mua ngay</button>
                                        </form>
                                    </div>

                                    {{-- product short description removed from card; full details on product page only --}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">Không có sản phẩm hot.</div>
                    @endforelse
                </div>

                <h4 class="mb-3">Sản phẩm rẻ nhất</h4>
                <div class="row g-3">
                    @forelse($cheapProducts as $product)
                        <div class="col-md-4">
                            <div class="card h-100">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</h6>
                                    <p class="text-muted mb-2 small">{{ $product->category ? $product->category->name : '' }}</p>
                                    <p class="fw-bold text-success mb-2">₫{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="mt-auto d-flex gap-2">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                        <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="qty" value="1">
                                            <button class="btn btn-sm btn-success">Mua ngay</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">Không có sản phẩm rẻ.</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>
@endsection