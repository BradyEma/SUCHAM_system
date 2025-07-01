<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - GoldenFields Supplier Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            background: linear-gradient(180deg, #166534 0%, #14532d 100%);
        }
        .nav-item {
            transition: all 0.3s ease;
        }
        .nav-item:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }
        .nav-item.active {
            background-color: #f0fdf4;
            color: #14532d;
            font-weight: 600;
        }
        .product-card {
            transition: all 0.3s ease;
            border-left: 4px solid #22c55e;
        }
        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .badge-in-stock {
            background-color: #f0fdf4;
            color: #166534;
        }
        .badge-low-stock {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-out-of-stock {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 sidebar text-white p-6 space-y-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
                    <img src="{{ asset('goldenfields.png') }}" alt="GoldenFields Logo" class="h-8 w-8 rounded-full">
                </div>
                <div>
                    <div class="text-xl font-bold">GoldenFields</div>
                    <div class="text-xs text-green-200">Industries Ltd.</div>
                </div>
            </div>
            <nav class="space-y-1">
                <a href="{{ route('supplier.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('supplier.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-clipboard-list w-5 text-center"></i>
                    <span>Orders</span>
                </a>
                <a href="{{ route('supplier.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                    <i class="fas fa-boxes w-5 text-center"></i>
                    <span>Products</span>
                </a>
                
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-comment-dots w-5 text-center"></i>
                    <span>Chat</span>
                </a>
                <a href="{{ route('supplier.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-user w-5 text-center"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-green-800">Product Inventory</h1>
                    <p class="text-gray-600">Manage your product listings and inventory</p>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-file-export mr-2"></i> Export
                    </button>
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add Product
                    </button>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Category</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option>All Categories</option>
                            <option>Sugar Cane</option>
                            <option>Honey</option>
                            <option>Molasses</option>
                            <option>By-products</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock Status</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option>All Statuses</option>
                            <option>In Stock</option>
                            <option>Low Stock</option>
                            <option>Out of Stock</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option>All Prices</option>
                            <option>UGX 0 - 50,000</option>
                            <option>UGX 50,000 - 200,000</option>
                            <option>UGX 200,000+</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <div class="relative">
                            <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-500">Total Products</h2>
                            <p class="text-3xl font-bold text-green-700">24</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-700">
                            <i class="fas fa-box-open text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-500">In Stock</h2>
                            <p class="text-3xl font-bold text-green-700">18</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 text-blue-700">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-500">Low Stock</h2>
                            <p class="text-3xl font-bold text-yellow-700">4</p>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-700">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Product 1 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('sugarcane.jpg') }}" alt="Sugar Cane">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Premium Sugar Cane</div>
                                            <div class="text-sm text-gray-500">SKU: SC-001</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Sugar Cane</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">12,500 kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">UGX 1,200/kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full badge-in-stock">
                                        In Stock
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-yellow-600 hover:text-yellow-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Product 2 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('honey.jpg') }}" alt="Pure Honey">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Pure Golden Honey</div>
                                            <div class="text-sm text-gray-500">SKU: HN-002</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Honey</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">850 jars</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">UGX 15,000/jar</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full badge-in-stock">
                                        In Stock
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-yellow-600 hover:text-yellow-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Product 3 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('molasses.jpg') }}" alt="Molasses">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Blackstrap Molasses</div>
                                            <div class="text-sm text-gray-500">SKU: ML-003</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">By-products</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">320 kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">UGX 8,500/kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full badge-low-stock">
                                        Low Stock
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-yellow-600 hover:text-yellow-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Product 4 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('sugar-beets.jpg') }}" alt="Sugar Beets">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Organic Sugar Beets</div>
                                            <div class="text-sm text-gray-500">SKU: SB-004</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Sugar Beets</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">0 kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">UGX 3,200/kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full badge-out-of-stock">
                                        Out of Stock
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-yellow-600 hover:text-yellow-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">24</span> products
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" aria-current="page" class="z-10 bg-yellow-50 border-yellow-500 text-yellow-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    1
                                </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    2
                                </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    3
                                </a>
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                    ...
                                </span>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    8
                                </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>