<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md border border-gray-200">
      <h1 class="text-3xl text-green-700 font-bold mb-6 text-center">Add Product</h1>

      <form action="{{ route('supplier_inventory.store') }}" method="POST" class="space-y-4">
        @csrf
        
        @if ($errors->any())
          <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif

        <div>
          <label class="block font-medium text-gray-700">Product Name:</label>
          <input 
            type="text" 
            name="product_name" 
            required 
            class="mt-1 w-full border px-4 py-2 rounded border-green-300 focus:ring-green-500 focus:border-green-500"
            value="{{ old('product_name') }}"
          />
        </div>

        <div>
          <label class="block font-medium text-gray-700">Product ID:</label>
          <input 
            type="number" 
            name="product_id" 
            required 
            class="mt-1 w-full border px-4 py-2 rounded border-green-300 focus:ring-green-500 focus:border-green-500"
            value="{{ old('product_id') }}"
          />
        </div>

        <div>
          <label class="block font-medium text-gray-700">Quantity:</label>
          <input 
            type="number" 
            name="quantity" 
            required 
            class="mt-1 w-full border px-4 py-2 rounded border-green-300 focus:ring-green-500 focus:border-green-500"
            value="{{ old('quantity') }}"
          />
        </div>

        <div>
          <label class="block font-medium text-gray-700">Unit Price:</label>
          <input 
            type="number" 
            name="unit_price" 
            required 
            step="0.01"
            class="mt-1 w-full border px-4 py-2 rounded border-green-300 focus:ring-green-500 focus:border-green-500"
            value="{{ old('unit_price') }}"
          />
        </div>

        <div>
          <label for="unit" class="block font-medium text-gray-700">Unit of Measurement:</label>
          <select 
            id="unit" 
            name="unit_of_measurement" 
            required
            class="mt-1 block w-full p-3 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
          >
            <option value="" disabled selected>Select unit</option>
            <option value="kg" {{ old('unit_of_measurement') == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
            <option value="g" {{ old('unit_of_measurement') == 'g' ? 'selected' : '' }}>Grams (g)</option>
            <option value="L" {{ old('unit_of_measurement') == 'L' ? 'selected' : '' }}>Liters (L)</option>
            <option value="ml" {{ old('unit_of_measurement') == 'ml' ? 'selected' : '' }}>Milliliters (ml)</option>
            <option value="pcs" {{ old('unit_of_measurement') == 'pcs' ? 'selected' : '' }}>Pieces</option>
            <option value="bags" {{ old('unit_of_measurement') == 'bags' ? 'selected' : '' }}>Bags</option>
            <option value="boxes" {{ old('unit_of_measurement') == 'boxes' ? 'selected' : '' }}>Boxes</option>
          </select>
        </div>

        <div class="pt-2">
          <button 
            type="submit" 
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
          >
            Save Product
          </button>
        </div>

        <div>
          <a href="{{ route('supplier_inventory.index') }}" 
            class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
          >
            ← Back to Inventory
          </a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>