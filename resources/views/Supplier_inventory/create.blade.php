<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen flex flex-col items-center justify-center p-6">
  <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl text-green-700 font-bold mb-6 text-center">Add Inventory</h1>

    <form action="/supplier_inventory" method="POST" class="space-y-4">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      
      <label class="block font-medium">Product Name:</label>
      <input type="text" name="product_name" required class="w-full border px-4 py-2 rounded border-green-300">

      <label class="block font-medium">SKU:</label>
      <input type="number" name="SKU" required class="w-full border px-4 py-2 rounded border-green-300">

      <label class="block font-medium">Quantity:</label>
      <input type="number" name="quantity" required class="w-full border px-4 py-2 rounded border-green-300">

      <label class="block font-medium">Unit:</label>
      <input type="text" name="unit" value="kg" required class="w-full border px-4 py-2 rounded border-green-300">

      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded w-full">Save</button>
    </form>
  </div>
</body>
</html>