<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Product - Retailer Inventory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6fff5;
            color: #333;
            padding: 30px;
        }
        h1 {
            color: #228B22; /* Apple Green */
        }
        form {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[readonly] {
            background-color: #e9e9e9;
            cursor: not-allowed;
        }
        .button {
            background-color: #FFD700; /* Gold */
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
            cursor: pointer;
        }
        .button:hover {
            background-color: #e6be00;
        }
        .back {
            margin-top: 20px;
            display: inline-block;
            color: #228B22;
            text-decoration: none;
        }
        .error {
            color: red;
            margin-top: 5px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <h1>Add Product</h1>

    <form action="{{ route('retailer_inventory.store') }}" method="POST">
        @csrf

        <label for="product_name">Product Name</label>
        <select name="product_name" id="product_name" required onchange="setProductId(this.value)">
            <option value="">-- Select Product --</option>
            <option value="Brown Sugar" {{ old('product_name') == 'Brown Sugar' ? 'selected' : '' }}>Brown Sugar</option>
            <option value="White Sugar" {{ old('product_name') == 'White Sugar' ? 'selected' : '' }}>White Sugar</option>
        </select>
        @error('product_name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="product_id">Product ID</label>
        <input type="text" name="product_id" id="product_id" value="{{ old('product_id') }}" readonly required>
        @error('product_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required>
        @error('stock')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="unit_price">Unit Price</label>
        <input type="number" name="unit_price" id="unit_price" value="{{ old('unit_price') }}" step="0.01" required>
        @error('unit_price')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="measurements">Measurements</label>
        <input type="text" name="measurements" id="measurements" value="kgs" readonly required>
        @error('measurements')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="button">Save Product</button>
        <a href="{{ route('retailer_inventory.index') }}" class="back">← Back to Inventory</a>
    </form>

    <script>
        function setProductId(productName) {
            let productId = '';
            switch (productName) {
                case 'Brown Sugar':
                    productId = 'SKU001';
                    break;
                case 'White Sugar':
                    productId = 'SKU002';
                    break;
                default:
                    productId = '';
            }
            document.getElementById('product_id').value = productId;
        }

        // Set product_id on page load if a product is already selected (for old input)
        window.onload = function() {
            const selectedProduct = document.getElementById('product_name').value;
            if (selectedProduct) {
                setProductId(selectedProduct);
            }
        };
    </script>

</body>
</html>
