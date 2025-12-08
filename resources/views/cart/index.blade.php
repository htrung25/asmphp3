@extends('client.layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container my-5">
    <h3>Giỏ hàng của bạn</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart) || count($cart) == 0)
        <div class="alert alert-info">Giỏ hàng trống.</div>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    @if($item['image_url'])
                                        <img src="{{ $item['image_url'] }}" alt="" style="height:64px;object-fit:cover;margin-right:12px;">
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $item['name'] }}</div>
                                    </div>
                                </div>

                                @if(!empty($item['description']))
                                    <div class="mt-2">
                                        <div class="bg-dark text-white p-2" style="border-radius:4px;">
                                            <strong>Chi tiết:</strong>
                                            <div class="small">{{ $item['description'] }}</div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle">₫{{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="align-middle">
                                <form action="{{ route('cart.update') }}" method="POST" class="d-flex gap-2 align-items-center">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                    <input type="number" name="qty" value="{{ $item['qty'] }}" class="form-control" style="width:90px;">
                                    <button class="btn btn-sm btn-primary">Cập nhật</button>
                                </form>
                            </td>
                            <td class="align-middle">₫{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                            <td class="align-middle">
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger">Xóa giỏ hàng</button>
                </form>
            </div>
            <div>
                <strong>Tổng: ₫{{ number_format($total, 0, ',', '.') }}</strong>
                <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline-block ms-3">
                    @csrf
                    <button class="btn btn-success">Thanh toán</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
