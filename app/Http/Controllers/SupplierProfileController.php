<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SupplierProfileController extends Controller
{
    public function updatePassword(Request $request)
    {
        $supplier = Auth::guard('supplier')->user();

        // Validate the input
        $request->validate([
            'current_password'      => ['required'],
            'new_password'          => ['required', 'min:8', 'confirmed'],
        ]);

        // Check if current password matches
        if (!Hash::check($request->current_password, $supplier->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        $supplier->password = Hash::make($request->new_password);
        $supplier->save();

        return back()->with('status', 'Password updated successfully.');
    }
}
