@extends('books.layout')

@section('content')
<div class="container mt-4">
    <h2>Giỏ hàng của bạn</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hình</th>
                    <th>Tên sách</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach(session('cart') as $id => $item)
                    @php $total += $item['price'] * $item['quantity'] @endphp
                    <tr>
                        <td><img src="{{ asset('storage/' . $item['thumbnail']) }}" width="70"></td>
                        <td>
                            <strong>{{ $item['title'] }}</strong><br>
                            <small>{{ $item['author'] }}</small>
                        </td>
                        <td>{{ number_format($item['price']) }}₫</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width:60px;">
                                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['price'] * $item['quantity']) }}₫</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end fw-bold">Tổng tiền:</td>
                    <td colspan="2" class="text-danger fw-bold fs-4">{{ number_format($total) }}₫</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ url('/') }}" class="btn btn-secondary">Tiếp tục mua sắm</a>
        <button class="btn btn-success btn-lg">Thanh toán</button>
        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-warning">Làm trống giỏ</button>
        </form>
    @else
        <p>Giỏ hàng trống! <a href="{{ url('/') }}">Quay lại mua sắm</a></p>
    @endif
</div>
@endsection