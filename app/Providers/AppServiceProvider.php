<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasColumn('users', 'last_seen')) {
            View::composer('*', function ($view) {
                if (Auth::check()) {
                    Auth::user()->update(['last_seen' => now()]);
                }
            });
        }
    }
}
