<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetailerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $retailer = $user->retailer; // Assuming you have a `retailer()` relationship in your User model

        return view('dashboard.retailer-dashboard', compact('user', 'retailer'));
    }
}

