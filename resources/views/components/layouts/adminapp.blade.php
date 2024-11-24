<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>@stack('title')</title>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- SweetAlert2 -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


    <!-- Include Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    @yield('css')
    <meta name="theme-color" content="#7952b3">

    @livewireStyles
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .active-link {
            background-color: #212529;
            color: #f1f1f1 !important;
            font-weight: bold;
            text-decoration: none;
        }
    </style>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- @vite(['resources/css/dashboard.css']) --}}

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>
    @guest
        <header class="p-1 text-bg-dark">
            <div class="container">
                <div class="flex-wrap d-flex align-items-center justify-content-center justify-content-lg-start">
                    <a href="{{ route('admin.dashboard') }}"
                        class="mb-2 d-flex align-items-center mb-lg-0 text-light me-3 text-decoration-none">
                        <h3 class="text-warning">YuniqMart</h3>
                    </a>
                    <div class="ms-auto d-flex justify-content-lg-end">
                        <a href="{{ route('admin.login') }}" type="button" wire:navigate
                            class="me-2 {{ request()->is('admin.login') ? 'btn btn-sm btn-warning' : 'btn btn-sm btn-outline-warning' }}">Login</a>
                        <a href="{{ route('admin.register') }}" type="button" wire:navigate
                            class="{{ request()->is('admin.register') ? 'btn btn-sm btn-warning' : 'btn btn-sm btn-outline-warning' }}">Sign-up</a>
                    </div>
                </div>
            </div>
        </header>
        @yield('auth')
    @endguest
    @auth('admin')
        <header class="p-0 shadow navbar navbar-dark sticky-top bg-dark flex-md-nowrap">
            <a class="px-3 navbar-brand bg-dark col-md-3 col-lg-2 me-0 text-warning" href="#">YuniqMart</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
            <div class="w-100"></div>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    {{-- <a class="px-3 nav-link" href="#">Sign out</a> --}}
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="p-2 m-2 btn btn-sm btn-dark nav-link text-warning"><i
                                class="bi bi-box-arrow-right"></i> Sign
                            out</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="pt-3 position-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="/admin/dashboard" wire:navigate
                                    class="nav-link {{ request()->is('admin/dashboard') ? 'active-link' : '' }}"
                                    aria-current="page">
                                    <i class="bi bi-clipboard2-data"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active-link' : '' }}"
                                    href="{{ route('admin.orders') }}" wire:navigate>
                                    <i class="bi bi-cart-check-fill"></i>
                                    Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/products') ? 'active-link' : '' }}"
                                    wire:navigate href="/admin/products">
                                    <i class="bi bi-boxes"></i>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/categories') ? 'active-link' : '' }}"
                                    wire:navigate href="{{ route('categories') }}">
                                    <i class="bi bi-ui-checks-grid"></i>
                                    Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-people-fill"></i>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="bar-chart-2"></span>
                                    Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="layers"></span>
                                    Integrations
                                </a>
                            </li>
                        </ul>

                        <h6
                            class="px-3 mt-4 mb-1 sidebar-heading d-flex justify-content-between align-items-center text-muted">
                            <span>Saved reports</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <ul class="mb-2 nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Current month
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Last quarter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Social engagement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Year-end sale
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                    @isset($slot)
                        {{ $slot }}
                    @endisset
                </main>
            </div>
        </div>

        @stack('script')
    @endauth
    <!-- Include Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @livewireScripts

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script> --}}

</body>

</html>
