@extends('layout')

@section('main')
<div id="p-forgot-password">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <x-auth-card>
                <div class="mb-4">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors  class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-danger">{{ __('Email Password Reset Link') }}</button>
                        </div>
                    </div>
                </form>
            </x-auth-card>
        </div>
        <div class="col-4"></div>
    </div>
</div>
@endsection
