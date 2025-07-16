<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Product - Wholesaler Inventory</title>
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

    <form action="{{ route('wholesaler_inventory.store') }}" method="POST">
        @csrf

        <label for="product_name">Product Name</label>
        <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}" required>
         @error('product_id')
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

             <label for="unit" class="block font-medium mb-1">Measurements:</label>
      <select 
        id="unit" 
        name="Measurements" 
        required
        class="block w-full p-3 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
      >
        <option value="" disabled selected>Select unit</option>
        <option value="kg">Kilograms (kg)</option>
        <option value="g">Grams (g)</option>
        <option value="L">Liters (L)</option>
        <option value="ml">Milliliters (ml)</option>
        <option value="pcs">Pieces</option>
        <option value="bags">Bags</option>
        <option value="boxes">Boxes</option>
      </select>

        <button type="submit" class="button">Save Product</button>
        <a href="{{ route('wholesaler_inventory.index') }}" class="back">← Back to Inventory</a>
    </form>

    

</body>
</html>
