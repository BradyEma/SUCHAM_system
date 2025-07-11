<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen flex flex-col items-center justify-center p-6">
  <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl text-green-700 font-bold mb-6 text-center">Add Product</h1>

    <form action="{{ route('supplier_inventory.store') }}" method="POST" class="space-y-4">
      @csrf
      
      <label class="block font-medium">product_name:</label>
      <input 
        type="text" 
        name="product_name" 
        required 
        class="w-full border px-4 py-2 rounded border-green-300"
      />

      <label class="block font-medium">product_id:</label>
      <input 
        type="number" 
        name="product_id" 
        required 
        class="w-full border px-4 py-2 rounded border-green-300"
      />

      <label class="block font-medium">quantity:</label>
      <input 
        type="number" 
        name="quantity" 
        required 
        class="w-full border px-4 py-2 rounded border-green-300"
      />

      <label class="block font-medium">unit_price:</label>
      <input 
        type="number" 
        name="unit_price" 
        required 
        step="0.01"
        class="w-full border px-4 py-2 rounded border-green-300"
      />

      <label for="unit" class="block font-medium mb-1">unit_of_measurement:</label>
      <select 
        id="unit" 
        name="unit_of_measurement" 
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

      <button 
        type="submit" 
        class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded w-full"
      >
        Save
      </button>

      <a href="{{ route('supplier_inventory.index') }}" 
         class="block text-center mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded w-full"
      >
        ← Back to Inventory
      </a>
    </form>
  </div>
</body>
</html>
