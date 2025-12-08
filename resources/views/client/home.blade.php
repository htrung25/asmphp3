@extends('client.layouts.app')

@section('title', 'Trang chủ - Gundam Shop')

@section('content')
    <!-- Hero section, sản phẩm nổi bật... -->
    <div class="container my-5 text-center text-white">
        <h1 class="display-3 fw-bold">CHÀO MỪNG ĐẾN VỚI GUNDAM SHOP</h1>
        <p class="lead">Bộ sưu tập Gundam chính hãng lớn nhất Việt Nam</p>
        <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg mt-3">XEM NGAY</a>
    </div>
@endsection