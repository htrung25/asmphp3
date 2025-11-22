<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASM PHP3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="" alt="">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="https://png.pngtree.com/png-clipart/20230121/original/pngtree-book-logo-design-inspiration-png-image_8925017.png" alt="Website Logo" style="height: 150px; ">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><h3>Trang Chủ</h3></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.listall') }}"><h3>Tất cả sách</h3></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.list', 1) }}"><h3>Danh Sách</h3></a>
                    </li>
                </ul>
                <form class="d-flex ms-3" action="{{ route('books.search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Tìm kiếm sách" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-light text-center py-3">
        <div class="container">
            <p>&copy; {{ date('Y') }} Tran Huu Trung.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
