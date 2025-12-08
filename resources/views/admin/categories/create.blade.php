@extends('admin.layouts.admin')
@section('page-title', 'Tạo danh mục')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white"><h4>Tạo danh mục mới</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
            </div>
            <button class="btn btn-success">Tạo</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection
