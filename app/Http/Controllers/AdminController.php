<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DemandPrediction;
use App\Models\VendorValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    
   public function dashboard() 
{
    $suppliers = Supplier::with('user')->get();

    // Fetch the latest validation per supplier
    $validations = VendorValidation::select('vendor_validations.*')
        ->join(DB::raw('(SELECT MAX(id) as max_id FROM vendor_validations GROUP BY supplier_id) as latest'), function($join) {
            $join->on('vendor_validations.id', '=', 'latest.max_id');
        })
        ->get()
        ->keyBy('supplier_id'); // Keyed by supplier_id for easy lookup

    $predictions = DemandPrediction::orderBy('predicted_for')->take(6)->get();

    $forecastLabels = $predictions->pluck('predicted_for')->map(function ($date) {
        return \Carbon\Carbon::parse($date)->format('M Y');
    });

    $forecastData = $predictions->pluck('quantity');

    return view('dashboard.admin-dashboard', compact(
        'forecastLabels', 'forecastData', 'suppliers', 'validations'
    ));
}



    public function activateSupplier($id)
    {
        $supplier = Supplier::where('user_id', $id)->firstOrFail();
        $supplier->status = 'active';
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier has been activated.');
    }

   
public function showSupplier($id)
{
    $user = User::findOrFail($id);
    $supplier = Supplier::where('user_id', $user->id)->first();

    $vendorValidation = VendorValidation::where('supplier_id', $user->id)->latest()->first();
    $validation = $vendorValidation;

    return view('admin.supplier-show', compact('user', 'supplier', 'vendorValidation', 'validation'));
}


        public function suspendSupplier($id)
    {
        $supplier = Supplier::where('user_id', $id)->firstOrFail();
        $supplier->status = 'suspended';
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier suspended successfully.');
    }

    public function deactivateSupplier($id)
    {
        $supplier = Supplier::where('user_id', $id)->firstOrFail();
        $supplier->status = 'deactivated';
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier deactivated successfully.');
    }

    public function chatWithSupplier($id)
    {
        $supplier = Supplier::where('user_id', $id)->firstOrFail();
        return view('admin.chat-with-supplier', compact('supplier'));
    }

    public function profile()
{
    $admin = auth()->user(); // Get the logged-in admin user

    return view('dashboard.admin-profile', compact('admin'));
}

public function uploadProfilePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = auth()->user();

    // Store the image
    $path = $request->file('profile_picture')->store('profile_pictures', 'public');

    // Save path to DB (make sure your `users` table has a `profile_picture` column)
    $user->profile_picture = $path;
    $user->save();

    return redirect()->route('admin.profile')->with('success', 'Profile picture updated!');
}
  


}
