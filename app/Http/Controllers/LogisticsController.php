<?php

namespace App\Http\Controllers;

use id;
use App\Models\Logistic;
use App\Models\Logistics;
use Illuminate\Http\Request;
use App\Events\LogisticsUpdated;

class LogisticsController extends Controller
{
    public function index()
    {
        $logistics = Logistics::with('shipments')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.logistics.index', compact('logistics'));
    }

    public function create()
    {
        return view('admin.logistics.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'vehicle_no' => 'required|string|max:100',
        'route' => 'nullable|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    \App\Models\Logistic::create([
        'name' => $request->name,
        'vehicle_no' => $request->vehicle_no,
        'route' => $request->route,
        'status' => $request->status,
        'created_by' => auth()->id(), // optional
    ]);

    return redirect()->route('logistics')->with('success', 'Entry added successfully.');
}


    public function show(Logistics $logistic)
    {
        return view('admin.logistics.index', compact('logistic'));
    }

    public function update(Request $request, Logistic $logistic)
{
    // Update logic...
 $request->validate([
        'status' => 'required|in:pending,processing,shipped,completed,canceled',
    ]);

    $logistics = Logistics::findOrFail($id);
    $logistics->status = $request->status;
    $logistics->save();
 return back()->with('success', 'Status updated successfully.');
}

    public function destroy(Logistic $logistic)
    {
        $logistic->delete();
        return redirect()->route('logistics')->with('success', 'Logistic deleted successfully.');
    }

    // Add edit, destroy methods as needed
}