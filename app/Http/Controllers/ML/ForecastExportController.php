<?php
namespace App\Http\Controllers\ML;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class ForecastExportController extends Controller
{
    public function download()
    {
        $path = storage_path('app/data/demand_predictions.csv');
        if (!file_exists($path)) {
            return back()->with('error', 'No forecast data found.');
        }

        $rows = array_map('str_getcsv', file($path));
        $header = array_shift($rows);
        $data = array_map(function ($row) use ($header) {
            return array_combine($header, $row);
        }, $rows);

        $pdf = Pdf::loadView('ml.forecast-pdf', ['forecasts' => $data]);
        return $pdf->download('demand_forecast.pdf');
    }
}
