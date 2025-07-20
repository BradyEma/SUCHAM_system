<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcurementRequest;
use Illuminate\Support\Facades\Auth;

class ProcurementRequestController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $requests = ProcurementRequest::with('user')
        ->when($search, function ($query, $search) {
            return $query->where('product_name', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Changed from get() to paginate()

    return view('procurement_requests.index', compact('requests', 'search'));
}

    public function create()
    {
        return view('procurement_requests.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create the procurement request
        ProcurementRequest::create([
            'user_id' => Auth::id(),
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('procurement-requests.index')
            ->with('success', 'Request submitted successfully');
    }

    public function edit($id)
    {
        $request = ProcurementRequest::findOrFail($id);
        return view('procurement_requests.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,approved,rejected', // Ensure valid status
        ]);

        $procurementRequest = ProcurementRequest::findOrFail($id);
        $procurementRequest->update($validatedData);

        return redirect()->route('procurement-requests.index')
            ->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $procurementRequest = ProcurementRequest::findOrFail($id);
        $procurementRequest->delete();

        return redirect()->route('procurement-requests.index')
            ->with('success', 'Request deleted successfully');
    }

    public function show($id)
{
    $request = ProcurementRequest::findOrFail($id);
    return view('procurement_requests.show', compact('request'));
}
}