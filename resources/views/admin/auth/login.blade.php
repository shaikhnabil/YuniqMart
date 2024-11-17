{{-- @extends('admin.dashboard')
@push('title') Admin Login @endpush
@section('main') --}}
@extends('components.layouts.adminapp')
@push('title') Admin Login @endpush
@section('auth')
<div class="container">
    @if (session('status'))
        <x-alert :msg="session('status')"></x-alert>
    @endif
</div>
    {{-- <x-guest-layout> --}}
    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
    <div class="container">
    <div class="pt-3 mx-auto d-flex flex-column justify-content-center align-items-center w-50">
        <div class="px-4 py-3 mt-4 bg-white border rounded rounded-lg shadow w-100 sm-w-100">
            <h3 class="text-center fw-bold fs-3">Admin Login</h3>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1 form-control w-100" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 mb-3">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="mt-1 form-control w-100" type="password" name="password" required
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

                <div class="mt-4 d-flex align-items-center justify-content-end">
                    @if (Route::has('password.request'))
                        <a class="text-sm rounded text-decoration-underline text-muted hover-text-dark focus-outline-none focus-ring-2 focus-ring-offset-2 focus-ring-primary"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif


                    <x-primary-button class="btn btn-primary ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>

                </div>
                <a class="text-sm rounded text-decoration-underline text-muted hover-text-dark" href="{{ route('admin.register') }}">
                    {{ __('Not registered?') }}
                </a>
            </form>
        </div>
    </div>
</div>
    {{-- </x-guest-layout> --}}
@endsection
