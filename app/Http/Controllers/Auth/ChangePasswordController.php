<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ChangePasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.change-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        // $auth = Auth::guard('web')->validate( ['email' => $user->email, 'password' => $request->password_current] );

        // if( !$auth ) {
        //     return back()->withErrors(['password_current' => 'Wrong password.']);
        // }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        Session::flash('success', 'Password changed.');
        return redirect()->route('users.dashboard');


        // $request->validate([
        //     'password_current' => ['required'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $user = Auth::user();
        // $auth = Auth::guard('web')->validate( ['email' => $user->email, 'password' => $request->password_current] );

        // if( !$auth ) {
        //     return back()->withErrors(['password_current' => 'Wrong password.']);
        // }

        // $user->forceFill([
        //     'password' => Hash::make($request->password),
        //     'remember_token' => Str::random(60),
        // ])->save();

        // event(new PasswordReset($user));

        // Session::flash('success', 'Password changed.');
        // return redirect()->route('dashboard');
    }
}
