<!DOCTYPE html>
<html lang="vi">
<head>
    @include('admin.layouts.partials._head')
</head>
<body class="bg-light">

    @include('admin.layouts.partials._sidebar')

    <div style="margin-left: 260px;">
        <nav class="navbar navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <span class="h5 mb-0">@yield('page-title', 'Dashboard')</span>
                <span>Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
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