<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SupplierRegistrationController;


class SupplierRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-supplier');
    }

    public function register(Request $request)
    {
        try {
        Log::info('Supplier registration started.');
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'business_name' => 'required|string|max:255',
        'email' => 'required|email|unique:suppliers',
        'raw_material' => 'required|string',
        'tin_or_nin' => 'required|string',
        'location' => 'required|string',
        'verification_file' => 'required|file|mimes:pdf,doc,jpg,jpeg,png|max:20480', 
        'password' => 'required|string|confirmed|min:8',
    ]);
        
       Log::info('Validation passed.', $validated);
       $filePath = $request->file('verification_file')->store('verification_files', 'public');

        Supplier::create([
        'name' => $validated['name'],
        'business_name' => $validated['business_name'],
        'email' => $validated['email'],
        'raw_material' => $validated['raw_material'],
        'tin_or_nin' => $validated['tin_or_nin'],
        'location' => $validated['location'],
        'verification_file' => $filePath,
        'password' => Hash::make($validated['password']),
        'status' => 'pending', // 👈 default pending
         'role' => 'supplier',

         
    ]);

     Log::info('Supplier successfully saved.');
       return redirect()->route('login')->with('status', 'Registration submitted. Awaiting approval.');
        } catch (\Exception $e) {
        Log::error('Supplier registration failed: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong. Please try again.');
    }
    }
}
