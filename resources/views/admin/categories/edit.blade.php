@extends('admin.layouts.admin')
@section('page-title', 'Sửa danh mục')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white"><h4>Sửa danh mục</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
            </div>
            <button class="btn btn-success">Lưu thay đổi</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection
