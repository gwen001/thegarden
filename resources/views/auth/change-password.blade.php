@extends('layout')

@section('main')
<div id="p-change-password">
    <div class="row">
        <div class="col col-3">@include('components/user-menu',['active'=>'change-password'])</div>
        <div class="col col-1"></div>
        <div class="col-4 text-start">
            <x-auth-card>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.change') }}">
                    @csrf

                    <!-- Current Password -->
                    <!-- <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">{{ __('Current Password') }}</label>
                        <div class="col-sm-7">
                            <input type="password" id="password_current" name="password_current" class="form-control" required autocomplete="current-password">
                        </div>
                    </div> -->

                    <!-- New Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">{{ __('New Password') }}</label>
                        <div class="col-sm-7">
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">{{ __('Confirm') }}</label>
                        <div class="col-sm-7">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-danger">{{ __('Change Password') }}</button>
                        </div>
                    </div>
                </form>
            </x-auth-card>
            </div>
        <div class="col-4"></div>
    </div>
</div>
@endsection
