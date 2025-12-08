@extends('client.layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white"><h4>Chỉnh sửa thông tin</h4></div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label>Họ tên</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection