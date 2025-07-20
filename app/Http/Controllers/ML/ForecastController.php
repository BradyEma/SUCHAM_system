<?php

namespace App\Http\Controllers\ML;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForecastController extends Controller
{
    public function generate()
    {
        $pythonPath = 'C:\\Users\\pc\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';
        $scriptPath = base_path('ML/product_demand_forecast.py');

        $output = shell_exec("\"$pythonPath\" \"$scriptPath\" 2>&1");

        if (str_contains($output, 'Traceback') || str_contains($output, 'Error')) {
            return back()->with('error', 'Forecast generation failed: ' . nl2br($output));
        }

        return back()->with('success', '✅ Forecast generated successfully!🙂🙂.');
    }
}


