<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureSupplierProfileIsComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user is a supplier and doesn't have supplier profile
        if ($user->role === 'supplier' && !$user->supplier) {
            return redirect()->route('supplier.profile.form')
                ->with('error', 'Please complete your business profile before proceeding.');
        }

        return $next($request);
    }
}
