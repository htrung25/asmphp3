<!DOCTYPE html>
<html lang="vi">
<head>
    @include('admin.layouts.partials.header')
</head>
<body class="bg-light">

    @include('admin.layouts.partials.sidebar')

    <div style="margin-left: 260px;">
        <nav class="navbar navbar-light bg-white shadow-sm">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div>
                    <span class="h5 mb-0">@yield('page-title', 'Dashboard')</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div>Xin chào, <strong>{{ Auth::user()->name }}</strong></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Đăng xuất</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>