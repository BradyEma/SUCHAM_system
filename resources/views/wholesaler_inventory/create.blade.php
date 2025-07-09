<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - Wholesaler Inventory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6fff5;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border: 2px solid #b5d19c;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #5b8c00;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #d4af37;
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c29e2e;
        }
        .back-link {
            margin-top: 20px;
            display: inline-block;
            color: #5b8c00;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Product to Inventory</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('wholesaler_inventory.store') }}" method="POST">
            @csrf

            <label for="product_id">Product ID</label>
            <input type="text" id="product_id" name="product_id" value="{{ old('product_id') }}" required>

            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}" required>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 0) }}" min="0" required>

            <label for="units">Units</label>
            <select id="units" name="units" required>
                <option value="">-- Select Unit --</option>
                <option value="kg" {{ old('units') == 'kg' ? 'selected' : '' }}>KG</option>
                <option value="litres" {{ old('units') == 'litres' ? 'selected' : '' }}>Litres</option>
                <option value="bags" {{ old('units') == 'bags' ? 'selected' : '' }}>Bags</option>
            </select>

            <label for="unit_price">Unit Price</label>
            <input type="number" step="0.01" id="unit_price" name="unit_price" value="{{ old('unit_price') }}" required>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="">-- Select Status --</option>
                <option value="in_stock" {{ old('status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
            </select>

            <button type="submit">Add Product</button>
        </form>

        <a class="back-link" href="{{ route('wholesaler_inventory.index') }}">← Back to Inventory</a>
    </div>
</body>
</html>
