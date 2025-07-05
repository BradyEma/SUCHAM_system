<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\VendorValidation;
use Illuminate\Support\Facades\Auth;

class VendorValidationController extends Controller
{
    public function submit(Request $request)
{
    $validated = $request->validate([
        'brn' => 'required|string',
        'annual_revenue' => 'required|numeric',
        'net_profit_margin' => 'required|numeric',
        'years_of_operation' => 'required|numeric',
        'customer_rating' => 'required|numeric|max:5',
        'tax_clearance' => 'required|string',
        'background_check' => 'required|string',
        'financial_stability' => 'required|string',
        'reputation' => 'required|string',
        'regulatory_compliance' => 'required|string',
    ]);

    // Step 1: Save data in DB without the response
    $validation = new VendorValidation();
    $validation->supplier_id = Auth::id();
    $validation->fill($validated); // only works if $fillable is set
    $validation->pdf_path = ''; // temp value
    $validation->save();

    
    // Step 2: Generate PDF and update pdf_path
$pdf = Pdf::loadView('pdf.vendor-validation', $validated);
$pdfName = 'vendor_validation_' . $validation->id . '.pdf';
$relativePath = 'vendor_validations/' . $pdfName;
$absolutePath = storage_path('app/public/' . $relativePath);

// Ensure the directory exists
if (!file_exists(dirname($absolutePath))) {
    mkdir(dirname($absolutePath), 0775, true);
}

$pdf->save($absolutePath);
$validation->pdf_path = $relativePath;
$validation->save();


    // Step 3: Send to Java server
   // Step 2: Generate PDF (Already done)
$pdfName = 'vendor_validation_' . $validation->id . '.pdf';
$pdfPath = storage_path('app/public/vendor_validations/' . $pdfName);

// Step 3: Send to Java server
$response = Http::attach(
    'file',
    file_get_contents($pdfPath),
    $pdfName
)->post('http://localhost:8080/api/vendors/upload');


    if ($response->successful()) {
    $validation->validation_result = $response->body();
    $validation->save();

    return redirect()->route('supplier.dashboard')->with('success', 'Vendor validation details submitted successfully.');
} else {
    $validation->validation_result = 'Failed: ' . $response->body();
    $validation->save();

    return redirect()->route('supplier.dashboard')->with('success', 'Vendor validation details submitted. Awaiting review.');
}

}
}
