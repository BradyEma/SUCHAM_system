<?php

namespace App\Http\Controllers;

use App\Models\Logistics;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            // Add other fields as needed
        ]);

        Logistics::create($validated);

        return redirect()->route('logistics.index')->with('success', 'Logistics record created successfully.');
    }

    public function show(Logistics $logistic)
    {
        return view('admin.logistics.show', compact('logistic'));
    }

    public function update(Request $request, Logistic $logistic)
{
    // Update logic...
    
    // Broadcast update
    event(new LogisticsUpdated($logistic));
    
    return redirect()->route('admin.logistics.index');
}

    // Add edit, destroy methods as needed
}