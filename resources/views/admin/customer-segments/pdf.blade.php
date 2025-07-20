<!DOCTYPE html>
<html>
<head>
    <title>Customer Segments</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Customer Segments Report</h2>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Order Amount</th>
                <th>Order Count</th>
                <th>Cluster</th>
            </tr>
        </thead>
        <tbody>
            @foreach($segments as $row)
                <tr>
                    <td>{{ $row['customer_id'] }}</td>
                    <td>{{ $row['order_amount'] }}</td>
                    <td>{{ $row['order_count'] }}</td>
                    <td>{{ $row['cluster'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
