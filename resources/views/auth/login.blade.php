<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng nhập - E-Commerce Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --brand: #2563eb;
            --brand-dark: #1d4ed8;
            --page-bg: #f5f7fb;
            --text-strong: #111827;
            --text-muted: #64748b;
            --border-soft: #e5e7eb;
            --shadow-soft: 0 18px 46px rgba(15, 23, 42, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.12), transparent 32rem),
                var(--page-bg);
            color: var(--text-strong);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .login-shell {
            width: min(100%, 430px);
        }

        .brand-lockup {
            margin-bottom: 22px;
            text-align: center;
        }

        .brand-mark {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: var(--brand);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            box-shadow: 0 14px 26px rgba(37, 99, 235, 0.24);
        }

        .brand-lockup h1 {
            margin: 14px 0 4px;
            font-size: 1.55rem;
            font-weight: 800;
            letter-spacing: 0;
        }

        .brand-lockup p {
            margin: 0;
            color: var(--text-muted);
        }

        .login-card {
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 8px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }

        .login-card .card-body {
            padding: 28px;
        }

        .form-label {
            color: #334155;
            font-weight: 700;
        }

        .form-control {
            border-color: var(--border-soft);
            border-radius: 7px;
            min-height: 46px;
        }

        .form-control:focus,
        .form-check-input:focus,
        .btn:focus-visible {
            border-color: var(--brand);
            outline: 3px solid rgba(37, 99, 235, 0.24);
            outline-offset: 2px;
            box-shadow: none;
        }

        .btn-primary {
            min-height: 46px;
            border-radius: 7px;
            background: var(--brand);
            border-color: var(--brand);
            font-weight: 800;
        }

        .btn-primary:hover {
            background: var(--brand-dark);
            border-color: var(--brand-dark);
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .login-card .card-body {
                padding: 22px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <div class="brand-lockup">
            <div class="brand-mark" aria-hidden="true">
                <i class="bi bi-shop"></i>
            </div>
            <h1>E-Commerce Admin</h1>
            <p>Đăng nhập để quản lý sản phẩm, đơn hàng và khách hàng.</p>
        </div>

        <div class="card login-card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            autocomplete="email"
                            autofocus
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            autocomplete="current-password"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Đăng nhập
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
