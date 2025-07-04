<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-6">
  <h1 class="text-3xl text-green-700 font-bold mb-6">Edit Inventory</h1>

  <form action="/supplier_inventory/{{ $supplier_inventory->id }}" method="POST" class="space-y-4 max-w-lg">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">

    <label class="block font-medium">Supplier:</label>
    <select name="supplier_id" required class="w-full border px-4 py-2 rounded border-green-300">
      @foreach ($suppliers as $supplier)
        <option value="{{ $supplier->user_id }}" @if($supplier->user_id == $supplier_inventory->supplier_id) selected @endif>
          {{ $supplier->business_name }}
        </option>
      @endforeach
    </select>

    <label class="block font-medium">Product Name:</label>
    <input type="text" name="product_name" value="{{ $supplier_inventory->product_name }}" required class="w-full border px-4 py-2 rounded border-green-300">

    <label class="block font-medium">SKU:</label>
    <input type="number" name="SKU" value="{{ $supplier_inventory->SKU }}" required class="w-full border px-4 py-2 rounded border-green-300">

    <label class="block font-medium">Quantity:</label>
    <input type="number" name="quantity" value="{{ $supplier_inventory->quantity }}" required class="w-full border px-4 py-2 rounded border-green-300">

    <label class="block font-medium">Unit:</label>
    <input type="text" name="unit" value="{{ $supplier_inventory->unit }}" required class="w-full border px-4 py-2 rounded border-green-300">

    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">Update</button>
  </form>
</body>
</html>