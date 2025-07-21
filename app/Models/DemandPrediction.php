<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'predicted_for',
        'quantity',
    ];
    public function index(Request $request)
    {
        $granularity = $request->input('group', 'month'); // 'month', 'week', or 'year'

        // Load from CSV (or database)
        $csv = Reader::createFromPath(storage_path('app/data/demand_predictions.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = collect($csv->getRecords());

        $data = $records->map(function ($row) use ($granularity) {
            return [
                'product' => $row['product'],
                'period' => $row['grouped_by_'.$granularity], // Example: '2025-08'
                'quantity' => $row['quantity'],
                'type' => $row['type'], // 'historical' or 'forecast'
            ];
        });

        return response()->json($data);
    }

}
