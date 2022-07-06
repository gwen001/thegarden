@extends('layout')

@section('main')
<div id="p-verify-email">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <x-auth-card>
                <div class="mb-4">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button type="submit" class="btn btn-danger">{{ __('Resend Verification Email') }}</button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-primary">{{ __('Log Out') }}</button>
                    </form>
                </div>
            </x-auth-card>
        </x-guest-layout>
        </div>
        <div class="col-4"></div>
    </div>
</div>
@endsection
