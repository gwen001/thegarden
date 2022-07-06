@extends('layout')

@section('main')
<div id="p-reset-password">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-start">
            <x-auth-card>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control" value="{!! old('email',$request->email) !!}" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Confirm') }}</label>
                        <div class="col-sm-8">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4 text-start col-form-label"></div>
                        <div class="col-8 text-start">
                            <button type="submit" class="btn btn-danger">{{ __('Reset Password') }}</button>
                        </div>
                    </div>
                </form>
            </x-auth-card>
            </div>
        <div class="col-4"></div>
    </div>
</div>
@endsection
