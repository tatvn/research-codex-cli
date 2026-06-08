<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/iconly.css') }}">
    @stack('styles')
</head>
<body>
    <script src="{{ asset('mazer/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('layouts.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('heading')</h3>
            </div>

            <div class="page-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ date('Y') }} &copy; Laravel Admin</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('mazer/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
