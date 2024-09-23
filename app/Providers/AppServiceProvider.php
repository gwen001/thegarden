<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use \App\Models\User;
use \App\Models\Order;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('order-view', function (User $user, Order $order) {
            return $user->id === $order->user_id;
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60000)->by($request->user()?->id ?: $request->ip());
        });
        RateLimiter::for('web', function (Request $request) {
            return Limit::perMinute(60000)->by($request->user()?->id ?: $request->ip());
        });
    }
}
