<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wholesaler;


class WholesalerController extends Controller
{
    public function dashboard()
{
    $user = Auth::user();
     $wholesaler = Wholesaler::where('user_id', $user->id)->first(); // assuming you have the relationship set

    return view('dashboard.wholesaler-dashboard', compact('user'));
}
  public function showProfileForm()
{
    $user = Auth::user(); // ✅ This gives you the logged-in user
    $wholesaler = Wholesaler::where('user_id', $user->id)->first();

    // ✅ Pass both $user and $wholesaler to the Blade view
    return view('dashboard.wholesaler-profile', compact('user', 'wholesaler'));
}


   public function storeProfile(Request $request)
{
    $request->validate([
        'business_name' => 'required|string',
        'phone' => 'required|string',
        'location' => 'required|string',
        'tin' => 'nullable|string',
        'document' => 'nullable|file|mimes:pdf|max:2048', // Allow PDF uploads
    ]);

    $userId = Auth::id();

    // Handle file upload
    $documentPath = null;
    if ($request->hasFile('document')) {
        $documentPath = $request->file('document')->store('documents', 'public');
    }

    Wholesaler::updateOrCreate(
        ['user_id' => $userId],
        [
            'business_name' => $request->business_name,
            'phone' => $request->phone,
            'location' => $request->location,
            'tin' => $request->tin,
            'status' => 'pending',
            'document_path' => $documentPath ?? Wholesaler::where('user_id', $userId)->value('document_path'),
        ]
    );

    return redirect()->route('wholesaler.dashboard')->with('success', 'Profile saved!');
}
}
