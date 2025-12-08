@extends('admin.layouts.admin')
@section('page-title', 'Sửa sản phẩm')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white"><h4>Sửa sản phẩm</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Giá</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="mb-3">
                <label>Kho</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
            </div>
            <div class="mb-3">
                <label>Danh mục</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Chọn --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Upload Image (thay thế)</label>
                <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if($product->image_url)
                    <div class="mt-2">
                        <img src="{{ $product->image_url }}" alt="" style="max-height:120px;">
                    </div>
                @endif
            </div>
            <button class="btn btn-success">Lưu thay đổi</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection
