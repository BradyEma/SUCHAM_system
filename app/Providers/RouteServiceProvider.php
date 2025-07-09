<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

class RouteServiceProvider extends ServiceProvider
{
    public static function redirectToDashboard()
    {
        $role = auth()->user()->role;

        return match ($role) {
            'supplier'   => route('supplier.dashboard'),
            'retailer'   => route('retailer.dashboard'),
            'wholesaler' => route('wholesaler.dashboard'),
            'customer'   => route('customer.dashboard'),
            default      => '/login',
        };
    }

    public function boot(): void
    {
        // ✅ Register the role middleware
        Route::aliasMiddleware('role', CheckRole::class);

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
