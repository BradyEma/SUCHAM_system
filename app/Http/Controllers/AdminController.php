<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DemandPrediction;
use App\Models\VendorValidation;


class AdminController extends Controller
{
    
   public function dashboard()
    {
       $suppliers = Supplier::with('user')->get();
$validations = VendorValidation::all()->keyBy('supplier_id'); // supplier_id == user_id


        // previous return view('dashboard.admin-dashboard', compact('suppliers', 'validations'));
        //everything below is new
        // Fetch demand predictions for the next 6 months
        $predictions = DemandPrediction::orderBy('predicted_for')->take(6)->get();

        $forecastLabels = $predictions->pluck('predicted_for')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('M Y');
        });

        $forecastData = $predictions->pluck('quantity');

        return view('dashboard.admin-dashboard', compact('forecastLabels', 'forecastData', 'suppliers'));
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


}
