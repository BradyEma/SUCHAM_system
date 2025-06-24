<?php

namespace App\Http\Controllers\Auth;
use App\Providers\RouteServiceProvider;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
  

public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // 🔍 If role is not selected yet → go to role selection
    if (!$user->role) {
        return redirect()->route('choose.role');
    }

   
    // ✅ Redirect based on role using centralized method
    return redirect()->to(RouteServiceProvider::redirectToDashboard());

}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
