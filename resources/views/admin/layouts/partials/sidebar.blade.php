<div class="bg-dark text-white vh-100 position-fixed" style="width: 260px; top:0; left:0;">
    <div class="p-4">
        <h4 class="text-center text-danger fw-bold">ADMIN PANEL</h4>
        <hr class="border-secondary">
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white rounded {{ request()->routeIs('admin.dashboard') ? 'bg-danger' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.products.index') }}" class="nav-link text-white rounded {{ request()->routeIs('admin.products.*') ? 'bg-danger' : '' }}">
                    <i class="bi bi-box-seam"></i> Sản phẩm
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.categories.index') }}" class="nav-link text-white rounded {{ request()->routeIs('admin.categories.*') ? 'bg-danger' : '' }}">
                    <i class="bi bi-tags"></i> Danh mục
                </a>
            </li>
            <!-- Thêm các menu khác ở đây -->
        </ul>
    </div>
</div>