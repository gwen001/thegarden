@extends('layout')

@section('main')
<div id="p-register">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <x-auth-card>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- UserName -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Username') }}</label>
                        <div class="col-sm-8">
                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-8">
                            <input type="text" id="fullname" name="fullname" class="form-control" value="{{ old('fullname') }}" required>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Confirm') }}</label>
                        <div class="col-sm-8">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-6 text-start col-form-label">
                            <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-info">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </x-auth-card>
        </div>
        <div class="col-4"></div>
    </div>
</div>
@endsection