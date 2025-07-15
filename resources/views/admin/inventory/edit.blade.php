<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Inventory Item | GoldenFields Agro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        secondary: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header would be included here in a full application -->
        
        <!-- Main Content -->
        <main class="flex-1 py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit This Inventory Item</h1>
                            <p class="mt-1 text-gray-600">Fill in the details below to edit this product to your inventory</p>
                        </div>
                        <a href="{{ route('admin.inventory.index') }}" class="flex items-center text-primary-600 hover:text-primary-800">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Inventory
                        </a>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <!-- Form Header -->
                    <div class="bg-gradient-to-r from-primary-600 to-primary-800 px-6 py-4 text-white">
                        <h2 class="text-lg font-semibold">
                            <i class="fas fa-box-open mr-2"></i> Product Information
                        </h2>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mx-6 mt-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
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

                    <!-- Form Content -->
                    <form 
    action="{{ isset($inventory) ? route('admin.inventory.update', $inventory->id) : route('admin.inventory.store') }}" 
    method="POST" 
    enctype="multipart/form-data" 
    class="p-6 space-y-6"
>
    @csrf
    @if(isset($inventory))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Product Name -->
        <div class="col-span-2">
            <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">
                Product Name *
            </label>
            <input type="text" id="product_name" name="product_name" required
                value="{{ old('product_name', $inventory->product_name ?? '') }}"
                class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                placeholder="e.g. Golden Sugar 5kg">
        </div>

        <!-- SKU -->
        <div>
            <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">
                SKU (Stock Keeping Unit)
            </label>
            <input type="text" id="sku" name="sku"
                value="{{ old('sku', $inventory->sku ?? '') }}"
                class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                placeholder="e.g. GF-SUG-5KG">
        </div>

        <!-- Quantity -->
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">
                Quantity in Stock *
            </label>
            <input type="number" id="quantity" name="quantity" required min="0"
                value="{{ old('quantity', $inventory->quantity ?? '') }}"
                class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                placeholder="e.g. 100">
        </div>

        <!-- Unit -->
        <div>
            <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">
                Unit of Measurement *
            </label>
            <select id="unit" name="unit_of_measurement" required
                class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                <option value="">Select unit</option>
                @foreach (['kg', 'g', 'L', 'ml', 'pcs', 'bags', 'boxes'] as $unit)
                    <option value="{{ $unit }}" {{ old('unit_of_measurement', $inventory->unit_of_measurement ?? '') == $unit ? 'selected' : '' }}>
                        {{ ucfirst($unit) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                Unit Price (UGX)
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500">UGX</span>
                </div>
                <input type="number" step="0.01" id="price" name="unit_price" min="0"
                    value="{{ old('unit_price', $inventory->unit_price ?? '') }}"
                    class="block w-full pl-16 p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                    placeholder="0.00">
            </div>
        </div>

        <!-- Supplier Email -->
        <div>
            <label for="supplier_email" class="block text-sm font-medium text-gray-700 mb-1">
                Supplier Email
            </label>
            <select name="supplier_email" class="form-control">
                <option disabled {{ empty(old('supplier_email', $inventory->supplier_email ?? '')) ? 'selected' : '' }}>Select Supplier Email</option>
                @foreach ($suppliers as $supplier)
                    @if ($supplier->user)
                        <option value="{{ $supplier->user->email }}" 
                            {{ old('supplier_email', $inventory->supplier_email ?? '') == $supplier->user->email ? 'selected' : '' }}>
                            {{ $supplier->user->email }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Reorder Level -->
        <div>
            <label for="reorder_level" class="block text-sm font-medium text-gray-700 mb-1">
                Reorder Level
            </label>
            <input type="number" id="reorder_level" name="minimum_stock_level" min="0"
                value="{{ old('minimum_stock_level', $inventory->minimum_stock_level ?? '') }}"
                class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                placeholder="Minimum stock level">
            <p class="mt-1 text-sm text-gray-500">System will alert when stock reaches this level</p>
        </div>

        <!-- Image Upload -->
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
            <div class="mt-1 flex items-center gap-4">
                @if (isset($inventory) && $inventory->product_image)
                    <img src="{{ asset('storage/' . $inventory->product_image) }}" class="w-12 h-12 object-cover rounded-full">
                @else
                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </span>
                @endif
                <label class="ml-5 cursor-pointer">
                    <span class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 inline-flex items-center text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-upload mr-2"></i> Upload Image
                    </span>
                    <input type="file" class="sr-only" name="product_image">
                </label>
            </div>
        </div>

        <!-- Description -->
        <div class="col-span-2">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                Product Description
            </label>
            <textarea id="description" name="product_description" rows="3"
                class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                placeholder="Enter product details, features, etc.">{{ old('product_description', $inventory->product_description ?? '') }}</textarea>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="flex justify-end pt-6 border-t border-gray-200">
        <button type="reset"
            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            <i class="fas fa-times mr-2"></i> Reset
        </button>
        <button type="submit"
            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i> {{ isset($inventory) ? 'Update Product' : 'Save Product' }}
        </button>
    </div>
</form>

                </div>
            </div>
        </main>
    </div>

    <script>
        // Simple image preview functionality
        document.querySelector('input[name="image"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.querySelector('.inline-block.h-12.w-12');
                    preview.innerHTML = `<img src="${event.target.result}" class="h-full w-full object-cover">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>