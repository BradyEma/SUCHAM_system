<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use App\Models\SupplierApproval;
use Illuminate\Support\Facades\Auth;



class SupplierController extends Controller
{
    // Display all suppliers
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    // Show form to create a new supplier
    public function create()
    {
        return view('suppliers.create');
    }

    // Store a new supplier in the DB
    public function store(Request $request)
    {
        $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:suppliers,email',
        'pdf'   => 'required|mimes:pdf|max:2048', // 🛑 required
        ]);


        $data = $request->only('name', 'email');

        if ($request->hasFile('pdf')) {
            $path = $request->file('pdf')->store('supplier_docs', 'public');
            $data['pdf_path'] = $path;
        }

        $data['verification_status'] = 'pending';

        Supplier::create($data);

        return redirect()->route('suppliers.index')->with('success', 'Supplier registered successfully.');
    }
    // verification of supplier
    public function approve(Supplier $supplier)
    {
        if (!$supplier->pdf_path) {
            return redirect()->route('suppliers.index')
                ->with('error', 'Cannot approve: no PDF uploaded.');
        }

        $supplier->update(['verification_status' => 'approved']);

        SupplierApproval::create([
            'supplier_id' => $supplier->id,
            'user_id' => Auth::id(),
            'action' => 'approved',
            'note' => 'Approved by admin',
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier approved.');
    }


    public function reject(Supplier $supplier)
    {
        $supplier->update(['verification_status' => 'rejected']);

        SupplierApproval::create([
            'supplier_id' => $supplier->id,
            'user_id' => Auth::id(),
            'action' => 'rejected',
            'note' => 'Rejected by admin',
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier rejected.');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    
}
