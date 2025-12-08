@extends('admin.layouts.admin')
@section('page-title', 'Admin Dashboard')

@section('styles')
<style>
    .admin-stats .stat-card { border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.06); }
    .admin-stats .stat-card .icon { font-size: 28px; opacity: .85; }
    .admin-stats .stat-value { font-size: 36px; font-weight: 700; }
    .admin-stats .stat-title { font-size: 14px; color: #6c757d; }
    @media (max-width: 576px) { .admin-stats .stat-value { font-size: 28px; } }
</style>
@endsection

@section('content')
<div class="mb-3">
    <h3 class="mb-0">Dashboard</h3>
    <p class="text-muted">Chào mừng <strong>{{ Auth::user()->name }}</strong> đến trang quản trị.</p>
</div>

<div class="row admin-stats g-3 mb-4">
    <div class="col-md-4">
        <div class="p-4 bg-white stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-title">Tổng sản phẩm</div>
                    <div class="stat-value">{{ $productsCount ?? 0 }}</div>
                </div>
                <div class="text-danger icon">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-4 bg-white stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-title">Tổng danh mục</div>
                    <div class="stat-value">{{ $categoriesCount ?? 0 }}</div>
                </div>
                <div class="text-warning icon">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-4 bg-white stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-title">Tổng người dùng</div>
                    <div class="stat-value">{{ $usersCount ?? 0 }}</div>
                </div>
                <div class="text-primary icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary me-2">Quản lý người dùng</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">Quản lý sản phẩm</a>
</div>
@endsection
