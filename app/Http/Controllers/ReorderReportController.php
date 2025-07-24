<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReorderReport;

class ReorderReportController extends Controller
{
    public function index(Request $request)
    {
        $query = ReorderReport::query();

        if ($request->has('material_name') && $request->material_name !== '') {
            $query->where('material_name', $request->material_name);
        }

        if ($request->has('date') && $request->date !== '') {
            $query->whereDate('requested_at', $request->date);
        }

        $reports = $query->orderBy('requested_at', 'desc')->paginate(10);
        $materials = ReorderReport::select('material_name')->distinct()->pluck('material_name');

        return view('admin.reorders.index', compact('reports', 'materials'));
    }
}
