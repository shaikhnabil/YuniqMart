{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @stack('title') </title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('css')
    @livewireStyles
</head>

<body style="background-color: #F7F7F8">
    <!-- header -->
    <header class="text-bg-dark">
        <div class="container">
            <div class="flex-wrap d-flex align-items-center justify-content-center justify-content-lg-start">
                <a href="/" wire:navigate
                    class="mb-2 d-flex align-items-start mb-lg-0 text-light me-3 text-decoration-none">
                    <h3 class="text-warning">*******</h3>
                </a>

                <ul class="mb-2 nav col-12 col-lg-auto me-lg-auto justify-content-center mb-md-0">
                    <li><a href="/" wire:navigate
                            class="nav-link px-2 {{ request()->is('/') ? 'text-white' : 'text-secondary' }}"><i
                                class="bi bi-house"> Home</i></a>
                    </li>
                    <li><a href="{{ route('cart.index') }}" wire:navigate
                            class="nav-link px-2 {{ request()->routeIs('cart.index') ? 'text-white' : 'text-secondary' }}">
                            <i class="bi bi-cart4"> Cart</i></a>
                    </li>
                    @auth
                        <li><a href="{{ route('myorders') }}" wire:navigate
                                class="nav-link px-2 {{ request()->routeIs('myorders') ? 'text-white' : 'text-secondary' }}">
                                <i class="bi bi-bag-heart-fill"> My Orders</i></a>
                        </li>

                        <li><a href="{{ route('manage.address') }}" wire:navigate
                                class="nav-link px-2 {{ request()->routeIs('manage.address') ? 'text-white' : 'text-secondary' }}">
                                <i class="bi bi-geo-alt"> Manage Address</i></a>
                        </li>

                        <li><a href="{{ route('profile.edit') }}" wire:navigate
                                class="nav-link px-2 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-secondary' }}">
                                <i class="bi bi-person"> Profile</i></a>
                        </li>

                        <!-- Notification -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link " href="#" role="button">
                                <i class="bi bi-bell text-secondary position-relative"></i>
                                <span class="top-2 badge text-bg-secondary position-absolute start-100 translate-middle">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu" id="dropdownMenu">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('products.show', $notification->data['product_id']) }}" wire:navigate
                                        class="text-decoration-none">
                                        <li class="p-3 m-2 border badge text-bg-light">
                                            <span class="badge text-bg-dark">Click me!</span>
                                            {{ $notification->data['message'] }}
                                            <a href="{{ route('markasreadone', $notification->id) }}"
                                                class="border-0 bg-light" aria-label="Close">
                                                <i class="bi bi-x-circle-fill text-danger"></i>
                                            </a>
                                        </li>
                                    </a>
                                @endforeach

                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <li class="p-0 text-center ">
                                        <a href="{{ route('mark-as-read') }}" class="btn btn-link text-decoration-none btn-sm" wire:navigate>
                                            <i class="bi bi-check2-all"> Mark all as read</i>
                                        </a>
                                    </li>
                                @else
                                    <p class="text-center text-muted">0 Notification</p>
                                @endif
                                    <div class="mx-auto w-50">
                                        <a href="{{ route('notifications') }}" wire:navigate
                                        class="btn btn-link text-decoration-none btn-sm">View all</a>
                                    </div>
                            </ul>
                        </li>

                    @endauth
                </ul>
                @auth
                    <div class="text-end">
                        <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                            @csrf
                            <button type="submit"
                                class="{{ request()->routeIs('logout') ? 'btn btn-warning' : 'text-warning border-0 bg-dark' }}"><i
                                    class="bi bi-box-arrow-left">
                                    Sign out</i></button>
                        </form>
                    </div>
                @endauth
                @guest
                    <div class="text-end">
                        <a href="/login" type="button" wire:navigate
                            class="me-2 {{ request()->is('login') ? 'btn btn-warning' : 'btn btn-outline-warning' }}">
                            <i class="bi bi-person-check"> Login</i></a>
                        <a href="/register" type="button" wire:navigate
                            class="{{ request()->is('register') ? 'btn btn-warning' : 'btn btn-outline-warning' }}">
                            <i class="bi bi-people"> Sign-up</i></a>
                    </div>
                @endguest
            </div>
        </div>

    </header> --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @stack('title') </title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('css')
    @livewireStyles
</head>

<body style="background-color: #EEEDEB">
    <!-- header -->
    <header class="text-bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a href="/" wire:navigate class="navbar-brand text-light me-3 text-decoration-none">
                    <h3 class="text-warning">*******</h3>
                </a>

                <!-- Toggler for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a href="/" wire:navigate
                                class="nav-link px-2 {{ request()->is('/') ? 'text-white' : 'text-secondary' }}"><i
                                    class="bi bi-house"> Home</i></a></li>
                        <li class="nav-item"><a href="{{ route('cart.index') }}" wire:navigate
                                class="nav-link px-2 {{ request()->routeIs('cart.index') ? 'text-white' : 'text-secondary' }}"><i
                                    class="bi bi-cart4"> Cart</i></a></li>
                        @auth
                            <li class="nav-item"><a href="{{ route('myorders') }}" wire:navigate
                                    class="nav-link px-2 {{ request()->routeIs('myorders') ? 'text-white' : 'text-secondary' }}"><i
                                        class="bi bi-bag-heart-fill"> My Orders</i></a></li>
                            <li class="nav-item"><a href="{{ route('manage.address') }}" wire:navigate
                                    class="nav-link px-2 {{ request()->routeIs('manage.address') ? 'text-white' : 'text-secondary' }}"><i
                                        class="bi bi-geo-alt"> Manage Address</i></a></li>
                            <li class="nav-item"><a href="{{ route('profile.edit') }}" wire:navigate
                                    class="nav-link px-2 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-secondary' }}"><i
                                        class="bi bi-person"> Profile</i></a></li>

                            <!-- Notification -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button">
                                    <i class="bi bi-bell text-secondary position-relative"></i>
                                    <span class="badge text-bg-secondary position-absolute start-100 translate-middle">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu" id="dropdownMenu">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <li class="p-3 m-2 border badge text-bg-light">
                                            <a href="{{ route('products.show', $notification->data['product_id']) }}"
                                                wire:navigate class="text-decoration-none">
                                                <span class="badge text-bg-dark">Click me!</span>
                                                {{ $notification->data['message'] }}
                                            </a>
                                            <a href="{{ route('markasreadone', $notification->id) }}"
                                                class="border-0 bg-light" aria-label="Close">
                                                <i class="bi bi-x-circle-fill text-danger"></i>
                                            </a>
                                        </li>
                                    @endforeach

                                    @if (auth()->user()->unreadNotifications->count() > 0)
                                        <li class="p-0 text-center">
                                            <a href="{{ route('mark-as-read') }}"
                                                class="btn btn-link text-decoration-none btn-sm" wire:navigate><i
                                                    class="bi bi-check2-all"> Mark all as read</i></a>
                                        </li>
                                    @else
                                        <p class="text-center text-muted">0 Notification</p>
                                    @endif
                                    <div class="mx-auto w-50">
                                        <a href="{{ route('notifications') }}" wire:navigate
                                            class="btn btn-link text-decoration-none btn-sm">View all</a>
                                    </div>
                                </ul>
                            </li>
                        @endauth
                    </ul>

                    <div class="d-flex">
                        @auth
                            <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                                @csrf
                                <button type="submit"
                                    class="{{ request()->routeIs('logout') ? 'btn btn-warning' : 'text-warning border-0 bg-dark' }}">
                                    <i class="bi bi-box-arrow-left"> Sign out</i>
                                </button>
                            </form>
                        @else
                            <a href="/login" wire:navigate
                                class="me-2 {{ request()->is('login') ? 'btn btn-sm btn-warning' : 'btn btn-sm btn-outline-warning' }}">
                                <i class="bi bi-person-check"> Login</i>
                            </a>
                            <a href="/register" wire:navigate
                                class="{{ request()->is('register') ? 'btn btn-sm btn-warning' : 'btn btn-sm btn-outline-warning' }}">
                                <i class="bi bi-people"> Sign-up</i>
                            </a>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </header>
