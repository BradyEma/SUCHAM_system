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

    $requests = ProcurementRequest::when($search, function ($query, $search) {
        return $query->where('product_name', 'like', "%{$search}%")
                     ->orWhere('status', 'like', "%{$search}%");
    })->paginate(10);

    return view('procurement_requests.index', compact('requests', 'search'));
}


    public function create()
    {
        return view('procurement_requests.create');
    }

    public function store(Request $request)
    {
        ProcurementRequest::create([
            'user_id' => Auth::id(),
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        return redirect()->route('procurement-requests.index')->with('success', 'Request submitted');
    }

    public function edit($id)
    {
        $request = ProcurementRequest::findOrFail($id);
        return view('procurement_requests.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $data = ProcurementRequest::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('procurement-requests.index')->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        ProcurementRequest::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }
}
