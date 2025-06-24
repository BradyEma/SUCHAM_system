<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // ✅ This line is essential

class RoleSelectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role) {
            return redirect()->route($user->role . '.dashboard');
        }

        return view('auth.choose-role');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:supplier,wholesaler,retailer,customer',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to select a role.');
        }

        $user->role = $request->role;
        $user->save();

        switch ($user->role) {
            case 'supplier':
                return redirect()->route('supplier.dashboard');
            case 'wholesaler':
                return redirect()->route('wholesaler.dashboard');
            case 'retailer':
                return redirect()->route('retailer.dashboard');
            case 'customer':
                return redirect()->route('customer.dashboard');
            default:
                return redirect()->route('home');
        }
    }
}
