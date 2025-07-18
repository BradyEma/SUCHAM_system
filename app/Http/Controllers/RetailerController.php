<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Retailer;
use App\Models\RetailerInventory;
use Illuminate\Support\Facades\Storage;
use App\Models\RetailerOrder;
use Carbon\Carbon;



class RetailerController extends Controller
{
   public function dashboard()
{
    $user = auth()->user();
    $retailer = $user->retailer;

    if (!$retailer) {
        $retailer = Retailer::create([
            'user_id' => $user->id,
            'status' => 'incomplete',
        ]);
    }

    $totalOrders = \App\Models\RetailerOrder::where('retailer_id', $retailer->id)
        ->distinct('transaction_id')
        ->count('transaction_id');
    
    $pendingOrders = RetailerOrder::where('retailer_id', $retailer->id)
    ->where('status', 'pending')
    ->distinct('transaction_id')
    ->count('transaction_id');

    $monthlySales = RetailerOrder::where('retailer_id', $retailer->id)
        ->where('status', 'completed')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('total');


    $totalProducts = \App\Models\RetailerInventory::where('retailer_id', $retailer->id)->count();

    $profileIsComplete = $retailer->business_name && $retailer->location && $retailer->contact_number;

    return view('dashboard.retailer-dashboard', compact(
        'user', 'retailer', 'profileIsComplete', 'totalOrders', 'totalProducts', 'pendingOrders', 'monthlySales'
    ));
}







  public function showProfileForm()
{
    $user = auth()->user(); // ← Add this

    $retailer = $user->retailer;

    if (!$retailer) {
        $retailer = \App\Models\Retailer::create([
            'user_id' => $user->id,
            'status' => 'incomplete',
        ]);
    }

    $profileIsComplete = $retailer->business_name && $retailer->location && $retailer->contact_number;

    
    return view('dashboard.retailer-profile', compact('user', 'retailer', 'profileIsComplete'));
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

public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = auth()->user();

        // Delete old picture if exists
        if ($user->profile_picture && Storage::exists($user->profile_picture)) {
            Storage::delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
        $user->save();

        return back()->with('success', 'Profile picture updated.');
    }

}

