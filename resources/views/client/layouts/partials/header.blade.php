<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Gundam Shop Việt Nam')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; color: #333; }
    .header-top { background: #FFB74D; padding: 8px 0; font-size: 14px; }
    .header-top .container { display: flex; justify-content: space-between; align-items: center; }
    .hotline { color: #333; font-weight: 500; }
    .store-system { color: #333; }
    .navbar { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 15px 0; }
    .navbar-brand { color: #FF6B35 !important; font-weight: bold; font-size: 28px; }
    .nav-link { color: #333 !important; font-weight: 500; transition: color 0.3s; }
    .nav-link:hover { color: #FF6B35 !important; }
    .account-btn { background: #FF6B35; color: white; border: 2px solid white; border-radius: 25px; padding: 8px 16px; display: flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s; }
    .account-btn:hover { background: #e55a2b; border-color: #f0f0f0; color: white; text-decoration: none; }
    .account-btn i { font-size: 16px; }
    .cart-icon { background: #FF6B35; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin-left: 15px; text-decoration: none; transition: background 0.3s; }
    .cart-icon:hover { background: #e55a2b; text-decoration: none; color: white; }

    /* Modern Dropdown Styles */
    .user-dropdown { position: relative; }
    .user-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        border: 1px solid #e0e0e0;
        min-width: 280px;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        margin-top: 8px;
    }
    .user-dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .dropdown-header {
        background: #f8f9fa;
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .user-info {
        padding: 20px;
        text-align: center;
    }
    .user-info-item {
        margin-bottom: 8px;
        font-size: 14px;
    }
    .user-info-label {
        font-weight: bold;
        color: #333;
        margin-right: 8px;
    }
    .user-info-value {
        color: #666;
    }
    .dropdown-actions {
        padding: 15px;
        border-top: 1px solid #e0e0e0;
        display: flex;
        gap: 10px;
    }
    .btn-detail, .btn-logout {
        flex: 1;
        background: #1976D2;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        text-align: center;
        transition: background 0.3s;
    }
    .btn-detail:hover, .btn-logout:hover {
        background: #1565C0;
        color: white;
        text-decoration: none;
    }

    .btn-primary { background: #FF6B35; border: none; }
    .btn-primary:hover { background: #e55a2b; }
</style>
@yield('styles')