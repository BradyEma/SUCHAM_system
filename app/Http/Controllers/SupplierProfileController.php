<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupplierProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'business_nameug' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'location' => 'required|string',
            'tax_id' => 'required|string|max:255',
            'tin' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $supplier = Supplier::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'business_name' => $request->business_name,
                'business_type' => $request->business_type,
                'location' => $request->location,
                'Tax_ID' => $request->tax_id,
                'TIN' => $request->tin,
                'document_path' => $request->hasFile('document') 
                    ? $request->file('document')->store('documents', 'public') 
                    : null,
            ]
        );

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
