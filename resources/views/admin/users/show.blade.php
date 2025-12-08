@extends('admin.layouts.admin')
@section('page-title', 'Chi tiết tài khoản')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white"><h4>Chi tiết tài khoản</h4></div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Họ tên:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>SĐT:</strong> {{ $user->phone ?? '-' }}</p>
        <p><strong>Quyền:</strong>
            @if($user->hasRole('admin'))
                <span class="badge bg-danger">Admin</span>
            @else
                <span class="badge bg-primary">User</span>
            @endif
        </p>
        <p><strong>Trạng thái:</strong>
            <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}
            </span>
        </p>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
        @if(auth()->user()->id !== $user->id)
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Xóa</button>
        </form>
        @endif
    </div>
</div>
@endsection
