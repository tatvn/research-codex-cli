<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dang nhap quan tri</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --mazer-primary: #435ebe;
            --mazer-primary-dark: #25396f;
            --mazer-bg: #f2f7ff;
            --mazer-border: #dce7f9;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
            background:
                radial-gradient(70rem 30rem at 0% -10%, rgba(67, 94, 190, 0.14) 0, transparent 65%),
                radial-gradient(60rem 25rem at 100% 120%, rgba(0, 198, 137, 0.12) 0, transparent 60%),
                var(--mazer-bg);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            border: 1px solid var(--mazer-border);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 20px 60px rgba(37, 57, 111, 0.12);
            overflow: hidden;
        }

        .auth-head {
            background: linear-gradient(135deg, var(--mazer-primary), #5d74cc);
            color: #fff;
            padding: 24px;
        }

        .auth-head h1 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 800;
        }

        .auth-body {
            padding: 24px;
        }

        .form-control {
            min-height: 46px;
            border-radius: 12px;
            border-color: #d8e1f5;
        }

        .form-control:focus {
            border-color: var(--mazer-primary);
            box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.15);
        }

        .btn-login {
            min-height: 46px;
            border-radius: 12px;
            border: 0;
            background: var(--mazer-primary);
            color: #fff;
            font-weight: 700;
        }

        .btn-login:hover {
            background: var(--mazer-primary-dark);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-head">
            <h1>Admin Panel</h1>
            <div class="opacity-75 mt-1">Dang nhap de quan ly he thong</div>
        </div>

        <div class="auth-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control"
                        placeholder="admin@example.com"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Mat khau</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="********"
                        required
                    >
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ghi nho dang nhap</label>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Dang nhap
                </button>
            </form>
        </div>
    </div>
</body>
</html>
