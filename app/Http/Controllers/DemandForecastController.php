<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DemandPrediction;

class DemandForecastController extends Controller
{

    public function exportPdf()
    {
        $predictions = DemandPrediction::all();

        $pdf = Pdf::loadView('admin.exports.demand-pdf', [
            'predictions' => $predictions
        ]);

        return $pdf->download('sugar_demand_forecast.pdf');
    }

}
