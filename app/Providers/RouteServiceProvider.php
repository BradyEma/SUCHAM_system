<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public static function redirectTo()
{
    $user = auth()->user();

    if (!$user) {
        return '/login';
    }

    return match ($user->role) {
        'admin' => '/admin/dashboard',
        'supplier' => '/supplier/dashboard',
        'customer' => '/customer/dashboard',
        default => '/dashboard',
    };
}
 

    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
