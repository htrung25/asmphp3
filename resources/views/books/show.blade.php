@extends('books.layout')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $book->thumbnail) }}" 
                 class="img-fluid rounded shadow" 
                 alt="{{ $book->title }}" 
                 style="max-height: 500px; object-fit: cover;">
        </div>

        <div class="col-md-7">
            <h1 class="fw-bold text-primary">{{ $book->title }}</h1>
            <p class="text-muted fs-5">Tác giả: <strong>{{ $book->author }}</strong></p>
            
            <div class="my-3">
                <span class="badge bg-success fs-6">Đã bán: {{ $book->sold_count ?? 0 }} cuốn</span>
                <span class="badge bg-info ms.2 fs-6">{{ $book->view_count ?? 0 }} lượt xem</span>
            </div>

            <hr>

            <p class="fs-1 text-danger fw-bold">{{ number_format($book->price) }}₫</p>

            <p><strong>Mô tả:</strong></p>
            <p class="text-justify">{!! nl2br(e($book->description ?? 'Chưa có mô tả')) !!}</p>

            <p><strong>Ngày xuất bản:</strong> {{ \Carbon\Carbon::parse($book->publication)->format('d/m/Y') }}</p>

            <!-- Form thêm vào giỏ hàng -->
            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-inline">
                @csrf
                <div class="input-group mb-3" style="width: 150px;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                    <input type="number" name="quantity" value="1" min="1" class="form-control text-center" required>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                </div>

                <button type="submit" class="btn btn-danger btn-lg px-5">
                    Thêm vào giỏ hàng
                </button>
            </form>

            <a href="{{ url('/') }}" class="btn btn-secondary btn-lg ms-3">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>
@endsection