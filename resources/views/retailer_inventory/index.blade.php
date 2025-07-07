<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Inventory</title>
    <style>
        :root {
            --apple-green: #2e8b57; /* More subtle green */
            --gold: #d4af37; /* Muted gold */
            --light-bg: #f9f9f9;
            --text-color: #333;
            --border-color: #e0e0e0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            padding: 20px;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 25px;
            border: 1px solid var(--border-color);
        }
        
        h1 {
            color: var(--apple-green);
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            font-size: 1.8rem;
        }
        
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .button {
            background-color: white;
            border: 1px solid var(--apple-green);
            color: var(--apple-green);
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 4px;
            margin-bottom: 15px;
            display: inline-block;
            transition: all 0.2s ease;
        }
        
        .button:hover {
            background-color: var(--apple-green);
            color: white;
        }
        
        .search-bar {
            padding: 8px 15px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            min-width: 250px;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 4px;
            overflow: hidden;
        }
        
        th {
            background-color: #f5f5f5;
            color: var(--text-color);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid var(--border-color);
        }
        
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }
        
        tr:hover {
            background-color: #fafafa;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-block;
        }
        
        .in-stock { 
            background-color: #e8f5e9;
            color: var(--apple-green);
            border: 1px solid #c8e6c9;
        }
        
        .low-stock { 
            background-color: #fff8e1;
            color: #ff8f00;
            border: 1px solid #ffe0b2;
        }
        
        .out-of-stock { 
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }
        
        .actions a {
            margin-right: 10px;
            color: var(--apple-green);
            text-decoration: none;
            font-weight: 500;
        }
        
        .actions a.delete {
            color: #c62828;
        }
        
        .price {
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            th, td {
                padding: 10px;
            }
            
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-bar {
                width: 100%;
                margin-top: 10px;
            }
             .sidebar {
            background: linear-gradient(180deg, #166534 0%, #14532d 100%);
        }
        }
    </style>
</head>
<body>
    
    <div class="container">
               
       <div>
  <h1>Inventory Management</h1>
<p class="text-gray-600" style="color: #ffff00; font-style: italic;">Manage your product listings and inventory</p>
</div>
            <a href="{{ route('retailer_inventory.create') }}" class="button">➕ Add Product</a>

            <input type="text" class="search-bar" placeholder="Search products...">
        </div>
 
       <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Product ID</th>
            <th>Stock</th>
            <th>Unit Price</th>
            <th>Measurements</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->unit_price }}</td>
                <td>{{ $product->measurements }}</td>
                <td>{{ $product->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No products found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination controls -->
<div class="mt-4">
    {{ $products->links() }}
</div>

    </div>
</body>
</html>