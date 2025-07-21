<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demand Forecast</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Demand Forecast Report</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Predicted For</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forecasts as $forecast)
                <tr>
                    <td>{{ $forecast['product'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($forecast['predicted_for'])->format('F Y') }}</td>
                    <td>{{ $forecast['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
