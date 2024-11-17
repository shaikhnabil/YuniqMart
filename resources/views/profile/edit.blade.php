@extends('layouts.main')
@push('title') Profile @endpush
@section('main')
    {{-- <x-app-layout> --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}
    {{-- </x-app-layout> --}}
    <div class="container">
        @if (session('status'))
            <x-alert :msg="session('status')"></x-alert>
        @endif
    </div>
    <div class="py-6">
        <div class="container my-3">
            <div class="p-4 mx-auto mb-4 bg-white rounded shadow-sm w-75">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 mx-auto mb-4 bg-white rounded shadow-sm w-75">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 mx-auto mb-4 bg-white rounded shadow-sm w-75">
                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
