<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\SupportTicket::class => \App\Policies\SupportTicketPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Define the "isAdmin" gate
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin'; // adjust to match your DB column
        });
    }
}
