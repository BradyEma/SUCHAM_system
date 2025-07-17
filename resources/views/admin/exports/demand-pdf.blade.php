<!DOCTYPE html>
<html>
<head>
    <title>Demand Forecast Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>📈 Sugar Demand Forecast</h2>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Predicted For</th>
                <th>Quantity (KG)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($predictions as $row)
                <tr>
                    <td>{{ $row->product }}</td>
                    <td>{{ $row->predicted_for }}</td>
                    <td>{{ number_format($row->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
