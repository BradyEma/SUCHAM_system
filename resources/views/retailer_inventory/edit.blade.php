<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6fff5;
            color: #333;
            padding: 30px;
        }
        h1 {
            color: #228B22;
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
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button {
            background-color: #FFD700;
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
    </style>
</head>
<body>

    <h1>Edit Product</h1>

    <form action="/retailer_inventory/update" method="POST">
        <!-- Add hidden ID or use Laravel Blade in real app -->
        <label for="product_name">Product Name</label>
        <input type="text" name="product_name" value="Refined Sugar 1kg" required>

        <label for="product_id">Product ID</label>
        <input type="text" name="product_id" value="SUG001" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="50" required>

        <label for="unit_price">Unit Price</label>
        <input type="number" name="unit_price" value="3.50" step="0.01" required>

        <label for="measurements">Measurements</label>
        <input type="text" name="measurements" value="kg" required>

        <button type="submit" class="button">Update Product</button>
        <a href="index.html" class="back">← Back to Inventory</a>
    </form>

</body>
</html>
