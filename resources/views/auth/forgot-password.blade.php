@extends('layouts.main')

@push('title')
    Forgot Password
@endpush

@section('main')
    <div class="container my-3">
        @if (session('status'))
            <x-alert :msg="session('status')"></x-alert>
        @endif
    </div>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center col-12 col-md-8 col-lg-6 mx-auto pt-3 px-3">
            <div class="w-100 mt-4 px-4 py-3 bg-white shadow-sm rounded-lg rounded">
                <h3 class="text-center mb-2">Forgot Password</h3>
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-100 form-control" type="email" name="email"
                            :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


{{-- @extends('layouts.main')
@push('title')
    Forgot Password
@endpush
@section('main')
    <div class="container">
        @if (session('status'))
            <x-alert :msg="session('status')"></x-alert>
        @endif
    </div>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center w-50 mx-auto pt-3">
            <div class="w-100 mt-4 px-4 py-3 bg-white shadow-sm rounded-lg sm-w-100 rounded">
                <h3 class="text-center mb-2">Forgot Password</h3>
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection --}}
