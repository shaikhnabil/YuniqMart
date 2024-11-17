{{-- @push('title') Register @endpush
@extends('layouts.main')
@section('main')
    <div class="container">
        <div class="pt-3 mx-auto mb-4 d-flex flex-column justify-content-center align-items-center w-50">
            <div class="px-4 py-3 mt-4 bg-white rounded shadow-sm w-100 sm-w-100">
                <h3 class="text-center fw-bold fs-3"><i class="bi bi-people"> Sign-up</i></h3>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label for="name" :value="__('Name *')" />
                        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email *')" />
                        <x-text-input id="email" class="form-control" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password *')" />
                        <x-text-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password *')" />
                        <x-text-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <x-input-label for="phone" :value="__('Phone *')" />
                        <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')"
                            maxlength="15" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <x-input-label for="image" :value="__('Profile Image')" />
                        <x-text-input id="image" class="form-control" type="file" name="image" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <x-input-label for="gender" :value="__('Gender *')" />
                        <select id="gender" name="gender" class="form-select">
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <x-input-label for="dob" :value="__('Date of Birth')" />
                        <input id="dob" class="form-control" type="date" name="dob" :value="old('dob')"  />
                        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                    </div>

                    <div class="mt-4 d-flex align-items-center justify-content-end">
                        <a class="text-sm rounded text-decoration-underline text-muted hover-text-dark" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="btn btn-primary ms-3">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection --}}

@push('title')
    Register
@endpush

@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="pt-3 mx-auto mb-4 d-flex flex-column justify-content-center align-items-center w-100">
            <div class="px-4 py-3 mt-4 bg-white rounded shadow-sm w-100" style="max-width: 500px;">
                <h3 class="text-center fw-bold fs-4"><i class="bi bi-people"></i> Sign-up</h3>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label for="name" :value="__('Name *')" />
                        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email *')" />
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password *')" />
                        <x-text-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password *')" />
                        <x-text-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <x-input-label for="phone" :value="__('Phone *')" />
                        <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')"
                            maxlength="15" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    {{-- <div class="mb-3">
                        <x-input-label for="image" :value="__('Profile Image')" />
                        <x-text-input id="image" class="form-control" type="file" name="image" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div> --}}

                    <!-- Gender -->
                    <div class="mb-3">
                        <x-input-label for="gender" :value="__('Gender *')" />
                        <select id="gender" name="gender" class="form-select">
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    <!-- Date of Birth -->
                    {{-- <div class="mb-3">
                        <x-input-label for="dob" :value="__('Date of Birth')" />
                        <input id="dob" class="form-control" type="date" name="dob" :value="old('dob')" />
                        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                    </div> --}}

                    <div class="mt-4 d-flex align-items-center justify-content-between">
                        <a class="text-sm rounded text-decoration-underline text-muted" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="btn btn-primary">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
