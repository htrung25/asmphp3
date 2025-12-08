@extends('client.layouts.app')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" class="img-fluid" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">Danh mục: {{ $product->category ? $product->category->name : 'Không rõ' }}</p>
            <p class="fw-bold fs-4 text-danger">₫{{ number_format($product->price, 0, ',', '.') }}</p>
            <p>Số lượng trong kho: <strong>{{ $product->stock }}</strong></p>

            <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center gap-2 ajax-add-cart">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="qty-control d-flex align-items-center" style="gap:6px;">
                    <button class="btn btn-outline-secondary qty-minus" type="button">-</button>
                    <input type="number" name="qty" class="product-qty" value="1" min="1" max="{{ $product->stock }}">
                    <button class="btn btn-outline-secondary qty-plus" type="button">+</button>
                </div>
                <button type="submit" class="btn btn-success">Mua ngay</button>
            </form>

            <form action="{{ route('cart.add') }}" method="POST" class="d-inline-block ms-2 ajax-add-cart" data-redirect="cart">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="redirect_to" value="cart">
                <button type="submit" class="btn btn-outline-primary">Thêm vào giỏ hàng</button>
            </form>
            

            @if($product->description)
                <div class="mt-3">
                    <div class="bg-dark text-white p-3" style="border-radius:6px;">
                        <strong>Thông tin chi tiết</strong>
                        <div class="mt-2">{!! nl2br(e($product->description)) !!}</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
