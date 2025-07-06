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

    $validation = new VendorValidation();
    $validation->supplier_id = Auth::id();
    $validation->fill($validated);
    $validation->pdf_path = ''; // placeholder
    $validation->save();

    // Generate PDF
    $pdf = Pdf::loadView('pdf.vendor-validation', $validated);
    $pdfName = 'vendor_validation_' . $validation->id . '.pdf';
    $relativePath = 'vendor_validations/' . $pdfName;
    $absolutePath = storage_path('app/public/' . $relativePath);

    if (!file_exists(dirname($absolutePath))) {
        mkdir(dirname($absolutePath), 0775, true);
    }

    $pdf->save($absolutePath);
    $validation->pdf_path = $relativePath;
    $validation->save();

    // Send to Java server
    $response = Http::attach(
        'file',
        file_get_contents($absolutePath),
        $pdfName
    )->post('http://localhost:8080/api/vendors/upload');

    // Handle response
    if ($response->successful()) {
        
        $responseData = json_decode($response->body(), true);

if (is_string($responseData)) {
    $responseData = json_decode($responseData, true); // handles double-encoding
}

// Set the result
$validation->validation_result = json_encode($responseData);

// ✅ Add visit_date manually if validation passed
if ($responseData['success']) {
    $validation->visit_date = now()->addDays(3);
}

$validation->save();

        return redirect()->route('supplier.dashboard')->with('success', 'Vendor validation details submitted successfully.');
    } else {
        $validation->validation_result = 'Failed: ' . $response->body();
        $validation->save();

        return redirect()->route('supplier.dashboard')->with('success', 'Vendor validation details submitted. Awaiting review.');
    }
}

}
