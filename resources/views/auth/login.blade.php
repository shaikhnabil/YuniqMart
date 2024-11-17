{{-- @push('title')
    Login
@endpush
@extends('layouts.main')
@section('main')
    <div class="container">
        @if (session('status'))
            <x-alert :msg="session('status')"></x-alert>
        @endif
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container">
        <div class="pt-3 mx-auto d-flex flex-column justify-content-center align-items-center w-50">
            <div class="px-4 py-3 mt-4 bg-white rounded-lg shadow-sm w-100 sm-w-100">
                <h3 class="text-center fw-bold fs-3"><i class="bi bi-person-check"> Login</i></h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email *')" />
                        <x-text-input id="email" class="mt-1 form-control w-100" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 mb-3">
                        <x-input-label for="password" :value="__('Password *')" />
                        <x-text-input id="password" class="mt-1 form-control w-100" type="password" name="password"
                            required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="mt-4 d-flex align-items-center justify-content-end">
                        @if (Route::has('password.request'))
                            <a class="text-sm rounded text-decoration-underline text-muted hover-text-dark focus-outline-none focus-ring-2 focus-ring-offset-2 focus-ring-primary"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="btn btn-sm btn-primary ms-3">
                            {{ __('Log in') }}
                        </x-primary-button>

                    </div>
                </form>

                <div class="container text-center">
                    <a href="{{ route('login.google') }}" class="mx-auto mt-4 rounded btn-sm btn btn-dark">
                        <span class="ms-2"><i class="bi bi-google text-danger"> </i> Login with Google</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection --}}


@push('title')
    Login
@endpush

@extends('layouts.main')

@section('main')
    <div class="container">
        @if (session('status'))
            <x-alert :msg="session('status')" />
        @endif

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="pt-3 mx-auto d-flex flex-column justify-content-center align-items-center w-100">
            <div class="px-4 border rounded  py-3 mt-4 bg-white rounded-lg shadow-sm w-100" style="max-width: 400px;">
                <h3 class="text-center fw-bold fs-4"><i class="bi bi-person-check"></i> Login</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-2">
                        <x-input-label for="email" :value="__('Email *')" />
                        <x-text-input id="email" class="mt-1 form-control" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-2">
                        <x-input-label for="password" :value="__('Password *')" />
                        <x-text-input id="password" class="mt-1 form-control" type="password" name="password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="mt-4 d-flex align-items-center justify-content-between">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-decoration-underline text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="btn btn-sm btn-primary">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="container text-center">
                    <a href="{{ route('login.google') }}" class="mx-auto mt-3 rounded btn btn-sm btn-primary">
                        <span class="ms-2"><i class="bi bi-google"></i> Login with Google</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
