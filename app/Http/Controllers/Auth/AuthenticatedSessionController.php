<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // var_dump( $request->method() );
        // var_dump( $request->query('q') );
        // var_dump( $request->get('q') );
        // var_dump( $request->post('q') );
        // var_dump( $request->all() );
        // var_dump( $request->collect() );
        // var_dump( $request->input() );
        // var_dump( $request->input('q') );
        // var_dump( $request->post() );
        // var_dump( Request::post() );
        // var_dump( $request->input('xxx') );
        // exit();

        $request->authenticate();

        $request->session()->regenerate();

        $r = $request->input('r',null);

        if( is_null($r) ) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect($r);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $r = $request->input('r',null);

        if( is_null($r) ) {
            return redirect('/');
        } else {
            return redirect($r);
        }
    }
}
