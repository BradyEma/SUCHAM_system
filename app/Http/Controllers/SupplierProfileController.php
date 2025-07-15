<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SupplierProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string',
            'business_type' => 'nullable|string',
            'telNo' => 'nullable|string',
            'tax_id' => 'nullable|string',
            'tin' => 'nullable|string',
            'location' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            Supplier::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'business_name' => $request->business_name,
                    'business_type' => $request->business_type,
                    'telNo' => $request->telNo,
                    'Tax_ID' => $request->tax_id,
                    'TIN' => $request->tin,
                    'location' => $request->location,
                    'document_path' => $request->hasFile('document') 
                        ? $request->file('document')->store('documents', 'public')
                        : null,
                    'status' => 'pending',
                ]
            );

            return redirect()->route('supplier.profile')->with('success', 'Business profile saved successfully. Please fill in the Vender-validations too.');

        } catch (\Exception $e) {
            return redirect()->route('supplier.profile')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function showProfile()
{
    $user = Auth::user();
    $supplier = Supplier::where('user_id', $user->id)->first();

    return view('dashboard.supplier-profile', compact('user', 'supplier'));
}

public function updateProfilePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Update user's profile_picture field
        $user->profile_picture = $path;
        $user->save();
    }

    return redirect()->back()->with('success', 'Profile picture updated successfully.');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully.');
}

public function deleteAccount(Request $request)
{
    $request->validate([
        'password' => 'required',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Incorrect password.']);
    }

    // Optional: delete linked supplier record
    if ($user->supplier) {
        $user->supplier->delete();
    }

    Auth::logout();
    $user->delete();

    return redirect('/')->with('success', 'Your account has been deleted.');
}

}
