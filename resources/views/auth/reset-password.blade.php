@extends('layouts.main')
@push('title') Reset Password @endpush
@section('main')
    {{-- <x-guest-layout> --}}
        <div class="container">
            @if (session('status'))
                <x-alert :msg="session('status')"></x-alert>
            @endif
        </div>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center w-50 mx-auto pt-3">
            <div class="w-100 mt-4 px-4 py-3 bg-white shadow-sm rounded-lg sm-w-100 rounded">
                <h3 class="text-center mb-2">Reset Password</h3>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- </x-guest-layout> --}}
@endsection
