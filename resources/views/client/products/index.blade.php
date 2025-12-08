@extends('client.layouts.app')

@section('title', 'Sản phẩm')

@section('content')
<div class="container my-5">
    <div class="row">
        <aside class="col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-danger text-white">Bộ lọc</div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="mb-2">
                            <label class="form-label">Từ khóa</label>
                            <input type="text" name="q" class="form-control" value="{{ request('q') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Danh mục</label>
                            <select name="category_id" class="form-select">
                                <option value="">-- Tất cả --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Giá từ</label>
                            <input type="number" name="price_min" class="form-control" value="{{ request('price_min') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Đến</label>
                            <input type="number" name="price_max" class="form-control" value="{{ request('price_max') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Sắp xếp</label>
                            <select name="sort" class="form-select">
                                <option value="">Mặc định</option>
                                <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                <option value="new" {{ request('sort')=='new' ? 'selected' : '' }}>Mới nhất</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">Áp dụng</button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Đặt lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

        <section class="col-md-9">
            <div class="row g-3">
                @forelse($products as $product)
                    <div class="col-md-4">
                        <div class="card h-100">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name, 60) }}</h6>
                                <p class="text-muted small">{{ $product->category? $product->category->name : '' }}</p>
                                <p class="fw-bold text-danger">₫{{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                    <form action="{{ route('cart.add') }}" method="POST" class="m-0 ajax-add-cart" data-redirect="">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button class="btn btn-sm btn-success">Mua ngay</button>
                                    </form>
                                </div>

                                {{-- short description removed from product card; show details on product page --}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">Không có sản phẩm phù hợp.</div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
