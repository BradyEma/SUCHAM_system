<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Retailer;


class RetailerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $retailer = $user->retailer; // Assuming you have a `retailer()` relationship in your User model

        return view('dashboard.retailer-dashboard', compact('user', 'retailer'));
    }
    public function showProfileForm()
    {
    $retailer = Retailer::where('user_id', auth()->id())->first();

    return view('dashboard.retailer-profile', compact('retailer'));
     }

     public function storeProfile(Request $request)
{
    $request->validate([
        'business_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'contact_number' => 'required|string|max:20',
        'tin' => 'nullable|string|max:100',
        'document' => 'nullable|file|mimes:pdf|max:2048',
    ]);

    $retailer = Retailer::firstOrNew(['user_id' => auth()->id()]);
    $retailer->business_name = $request->business_name;
    $retailer->location = $request->location;
    $retailer->contact_number = $request->contact_number;
    $retailer->tin = $request->tin;
    $retailer->status = 'pending';

    if ($request->hasFile('document')) {
        $path = $request->file('document')->store('retailer_documents', 'public');
        $retailer->document_path = $path;
    }

    $retailer->user_id = auth()->id();
    $retailer->save();

    return redirect()->route('retailer.dashboard')->with('success', 'Retailer profile updated successfully!');
}
}

