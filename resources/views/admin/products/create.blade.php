@extends('admin.layouts.admin')
@section('page-title', 'Tạo sản phẩm')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white"><h4>Tạo sản phẩm mới</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label>Giá</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
            </div>
            <div class="mb-3">
                <label>Kho</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" required>
            </div>
            <div class="mb-3">
                <label>Danh mục</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Chọn --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Upload Image</label>
                <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-success">Tạo</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection
