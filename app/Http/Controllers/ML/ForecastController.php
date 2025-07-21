<?php

namespace App\Http\Controllers\ML;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;

class ForecastController extends Controller
{
    public function generate()
    {
        $scriptPath = base_path('ML/product_demand_forecast.py');

        // Run the script and capture output (works better on Windows)
        $output = shell_exec("python \"$scriptPath\" 2>&1");

        if (str_contains($output, 'Traceback') || str_contains($output, 'Error')) {
            return back()->with('error', 'Forecast generation failed: ' . nl2br($output));
        }

        return back()->with('success', '✅ Forecast generated successfully!🙂🙂.');
    }

}


