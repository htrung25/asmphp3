@extends('admin.layouts.admin')
@section('page-title', 'Quản lý người dùng')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white">
        <h4>Danh sách tài khoản</h4>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->hasRole('admin'))
                            <span class="badge bg-danger">Admin</span>
                        @else
                            <span class="badge bg-primary">User</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $user->is_active ? 'btn-success' : 'btn-secondary' }} btn-sm">
                                {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">Xem</a>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection