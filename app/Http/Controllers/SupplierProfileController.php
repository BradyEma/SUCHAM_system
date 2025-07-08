<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;

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
}
