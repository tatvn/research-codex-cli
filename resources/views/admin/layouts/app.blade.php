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
            --sidebar-bg: #141923;
            --sidebar-hover: #202838;
            --sidebar-active: #2563eb;
            --header-height: 68px;
            --page-bg: #f5f7fb;
            --text-strong: #111827;
            --text-muted: #64748b;
            --border-soft: #e5e7eb;
            --shadow-soft: 0 12px 32px rgba(15, 23, 42, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: var(--page-bg);
            color: var(--text-strong);
            line-height: 1.5;
        }

        a,
        button,
        .btn {
            transition: background-color 0.18s ease, border-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
        }

        a:focus-visible,
        button:focus-visible,
        .btn:focus-visible,
        .form-control:focus,
        .form-select:focus {
            outline: 3px solid rgba(37, 99, 235, 0.28);
            outline-offset: 2px;
            box-shadow: none;
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
            box-shadow: 10px 0 30px rgba(15, 23, 42, 0.2);
        }

        #sidebar .sidebar-header {
            padding: 22px 24px;
            border-bottom: 1px rgba(255, 255, 255, 0.1) solid;
        }

        #sidebar .sidebar-header h3 {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0;
        }

        #sidebar .sidebar-header span {
            color: #60a5fa;
        }

        #sidebar .nav {
            padding: 8px 12px;
        }

        #sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 14px;
            font-size: 0.94rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s;
        }

        #sidebar .nav-link:hover {
            color: #fff;
            background: var(--sidebar-hover);
            transform: translateX(2px);
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
            min-height: var(--header-height);
            padding: 16px 32px;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .main-header h5 {
            color: var(--text-strong);
            font-weight: 750;
        }

        .content-wrapper {
            padding: 32px;
        }

        /* Cards */
        .stat-card {
            border: none;
            border-radius: 8px;
            box-shadow: var(--shadow-soft);
            transition: transform 0.2s;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card .card-body {
            padding: 22px;
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.83rem;
            font-weight: 700;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .stat-value {
            color: var(--text-strong);
            font-size: clamp(1.35rem, 2vw, 1.75rem);
            font-weight: 800;
            line-height: 1.15;
            overflow-wrap: anywhere;
        }

        /* Table */
        .table-card {
            border: none;
            border-radius: 8px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }

        .table {
            vertical-align: middle;
        }

        .table > :not(caption) > * > * {
            padding: 0.95rem 1rem;
        }

        .table th {
            font-weight: 750;
            color: #475569;
            font-size: 0.78rem;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-soft);
            background: #f8fafc;
        }

        /* Badge status */
        .badge-status {
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 750;
        }

        /* Page header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .page-header h4 {
            font-weight: 800;
            color: var(--text-strong);
            margin: 0;
        }

        .btn {
            border-radius: 7px;
            font-weight: 700;
        }

        .btn-primary {
            background-color: var(--sidebar-active);
            border-color: var(--sidebar-active);
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            transform: translateY(-1px);
        }

        .avatar-chip {
            width: 38px;
            height: 38px;
            background: #e0ecff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .empty-state {
            color: var(--text-muted);
            padding: 36px 16px;
        }

        .empty-state i {
            color: #94a3b8;
        }

        @media (max-width: 991.98px) {
            :root {
                --sidebar-width: 216px;
            }

            #sidebar .sidebar-header {
                padding: 18px;
            }

            .main-header,
            .content-wrapper {
                padding-left: 22px;
                padding-right: 22px;
            }
        }

        @media (max-width: 767.98px) {
            #sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                box-shadow: none;
            }

            #sidebar .sidebar-header {
                text-align: left;
            }

            #sidebar .nav {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 6px;
                margin-top: 0 !important;
            }

            #sidebar .nav-link {
                margin-bottom: 0;
            }

            #main-content {
                margin-left: 0;
            }

            .main-header {
                position: static;
                padding: 16px;
            }

            .content-wrapper {
                padding: 18px 14px 28px;
            }

            .page-header {
                align-items: stretch;
                flex-direction: column;
            }

            .page-header .btn {
                width: 100%;
            }

            .table > :not(caption) > * > * {
                padding: 0.85rem;
            }
        }

        @media (max-width: 420px) {
            #sidebar .nav {
                grid-template-columns: 1fr;
            }

            .main-header {
                align-items: flex-start;
                gap: 12px;
                flex-direction: column;
            }
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
                <div class="avatar-chip rounded-circle d-flex align-items-center justify-content-center"
                     aria-hidden="true">
                    <i class="bi bi-person-fill"></i>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Đăng xuất" aria-label="Đăng xuất">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng thông báo"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng thông báo"></button>
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
