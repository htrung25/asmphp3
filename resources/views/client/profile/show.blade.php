@extends('client.layouts.app')
@section('title', 'content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4>Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Trạng thái:</strong>
                        <span class="badge {{ Auth::user()->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ Auth::user()->is_active ? 'Hoạt động' : 'Bị khóa' }}
                        </span>
                    </p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Chỉnh sửa thông tin</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection