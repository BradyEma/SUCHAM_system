<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function showProfileForm()
    {
        return view('dashboard.supplier-profile');
    }

    public function showDashboard()
    {
        $user = Auth::user();
        $supplier = $user->supplier;

        $alert = null;

        if (!$supplier) {
            $alert = 'Please fill in your business details in Profile to continue.';
        } elseif ($supplier->status === 'pending') {
            $alert = 'Business Profile submitted successfully. Waiting for admin approval.';
        } elseif ($supplier->status === 'approved') {
            if (!session()->has('success')) {
                session()->flash('success', 'Your account is approved. You may now continue with business.');
            }
        }

        return view('dashboard.supplier-dashboard', compact('alert', 'supplier'));
    }
}
