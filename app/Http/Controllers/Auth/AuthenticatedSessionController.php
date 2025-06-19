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

    $credentials = $request->only('email', 'password');

    // Try authenticating user from users table
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        }

        return redirect()->route('dashboard'); // Fallback
    }

    // Try authenticating supplier from suppliers table
    $supplier = Supplier::where('email', $request->email)->first();

    if ($supplier && Hash::check($request->password, $supplier->password)) {
        if ($supplier->status !== 'approved') {
            return back()->withErrors(['email' => 'Your supplier account is pending approval.']);
        }

        // Manually login the supplier
        Auth::guard('supplier')->login($supplier);
        $request->session()->regenerate();

        return redirect()->route('supplier.dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided account doenot exist.',
    ]);
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
