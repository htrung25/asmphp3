<!DOCTYPE html>
<html lang="vi">
<head>
    @include('client.layouts.partials.header')
</head>
<body>

    @include('client.layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('client.layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('client.layouts.partials.scripts')
    @stack('scripts')
</body>
</html>