<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function showProfileForm()
    {
        return view('dashboard.supplier-profile');

    }

    public function storeProfile(Request $request)
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

        $supplier = Supplier::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'business_name' => $request->business_name,
                'business_type' => $request->business_type,
                'telNo' => $request->telNo,
                'tax_id' => $request->tax_id,
                'TIN' => $request->tin,
                'location' => $request->location,
                'document_path' => $request->hasFile('document')
                    ? $request->file('document')->store('documents', 'public')
                    : null,
            ]
        );

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}

