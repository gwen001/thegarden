@extends('layout')

@section('main')
<div id="p-login">
    <div class="row">
        <div class="col-4"></div>
        <div class="col text-start">
            <x-auth-card>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form action="{{ route('login') }}"  method="POST">
                    @csrf

                    <!-- UserName -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Username') }}</label>
                        <div class="col-sm-8">
                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" name="password" class="form-control" autocomplete="current-password" required>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <!-- <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8 text-start">
                            <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember">
                            <label class="form-check-label">{{ __('Remember me') }}</label>
                        </div>
                    </div> -->

                    <div class="row mt-5">
                        <div class="col-6 col-form-label">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-info">{{ __('Log in') }}</button>
                        </div>
                    </div>
                </form>
            </x-auth-card>
        </div>
        <div class="col-4"></div>
    </div>
</div>
@endsection