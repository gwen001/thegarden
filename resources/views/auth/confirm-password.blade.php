@extends('layout')

@section('main')
<div id="p-confirm-password">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <x-auth-card>
                <div class="mb-4 text-center">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                        <div class="col-sm-7">
                            <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-danger">{{ __('Confirm') }}</button>
                        </div>
                    </div>
                </form>
            </x-auth-card>
        </div>
        <div class="col-4"></div>
    </div>
</div>
@endsection
