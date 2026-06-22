<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - E-Commerce</title>

    <!-- Mazer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1e1e2d;
            --sidebar-hover: #2a2a3d;
            --sidebar-active: #3699ff;
            --header-height: 60px;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f2f7ff;
        }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px rgba(255, 255, 255, 0.1) solid;
        }

        #sidebar .sidebar-header h3 {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }

        #sidebar .sidebar-header span {
            color: var(--sidebar-active);
        }

        #sidebar .nav-link {
            color: #a2a3b7;
            padding: 12px 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 0;
            transition: all 0.2s;
        }

        #sidebar .nav-link:hover {
            color: #fff;
            background: var(--sidebar-hover);
        }

        #sidebar .nav-link.active {
            color: #fff;
            background: var(--sidebar-active);
        }

        #sidebar .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        /* Main content */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .main-header {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-wrapper {
            padding: 30px;
        }

        /* Cards */
        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-card .card-body {
            padding: 20px;
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Table */
        .table-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .table th {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            border-bottom: 2px solid #e9ecef;
        }

        /* Badge status */
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        /* Page header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h4 {
            font-weight: 700;
            color: #333;
            margin: 0;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><span>E</span>-Commerce</h3>
        </div>

        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                   href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags-fill"></i>
                    <span>Loại sản phẩm</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                   href="{{ route('admin.products.index') }}">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                   href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-cart-check-fill"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"
                   href="{{ route('admin.customers.index') }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Khách hàng</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Header -->
        <div class="main-header">
            <div>
                <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">{{ auth()->user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-box-arrow-right me-1"></i> Dang xuat
                    </button>
                </form>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                     style="width: 35px; height: 35px;">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
