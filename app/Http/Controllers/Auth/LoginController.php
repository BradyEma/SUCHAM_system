<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Try logging in as a user
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/customer/dashboard');
        }

        // Try logging in as a supplier (regardless of status)
        if (Auth::guard('supplier')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/supplier/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ]);
    }
}
