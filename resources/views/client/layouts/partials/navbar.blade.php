<!-- Header Top -->
<div class="header-top">
    <div class="container">
        <div class="hotline">
            <i class="fas fa-phone me-2"></i>Hotline: 1900 1234
        </div>
        <div class="store-system">
            <i class="fas fa-map-marker-alt me-2"></i>Hệ thống cửa hàng
        </div>
    </div>
</div>

<!-- Main Navigation -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            GUNDAM
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link px-4" href="{{ route('home') }}">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link px-4" href="{{ route('products.index') }}">Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link px-4" href="#">Liên hệ</a></li>
            </ul>

            <div class="d-flex align-items-center">
                @guest
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Đăng nhập</a>
                    <a class="btn btn-primary" href="{{ route('register') }}">Đăng ký</a>
                @else
                    <div class="user-dropdown">
                        <a class="account-btn" href="#" onclick="toggleUserDropdown(event)">
                            <i class="fas fa-user-circle"></i>
                            Tài khoản của bạn
                            <i class="fas fa-chevron-down ms-1"></i>
                        </a>
                        <div class="user-dropdown-menu" id="userDropdown">
                            <div class="dropdown-header">
                                THÔNG TIN TÀI KHOẢN
                            </div>
                            <div class="user-info">
                                <div class="user-info-item">
                                    <span class="user-info-label">Tên:</span>
                                    <span class="user-info-value">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="user-info-item">
                                    <span class="user-info-label">Email:</span>
                                    <span class="user-info-value">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="user-info-item">
                                    <span class="user-info-label">Số điện thoại:</span>
                                    <span class="user-info-value">{{ Auth::user()->phone ?? 'Chưa cập nhật' }}</span>
                                </div>
                            </div>
                            <div class="dropdown-actions">
                                <a href="{{ route('profile.show') }}" class="btn-detail">
                                    Xem chi tiết
                                </a>
                                <a href="{{ route('logout') }}" class="btn-logout"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                            </div>
                        </div>
                    </div>
                @endguest
                <a href="#" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleUserDropdown(event) {
    event.preventDefault();
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');

    // Close dropdown when clicking outside
    document.addEventListener('click', function closeDropdown(e) {
        if (!e.target.closest('.user-dropdown')) {
            dropdown.classList.remove('show');
            document.removeEventListener('click', closeDropdown);
        }
    });
}
</script>
