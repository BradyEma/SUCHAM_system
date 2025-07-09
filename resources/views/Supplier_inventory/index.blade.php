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
        .actions-dropdown {
            display: none;
            position: absolute;
            right: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            z-index: 10;
        }
        .actions-container:hover .actions-dropdown {
            display: block;
        }
        @media (max-width: 768px) {
            .table-header {
                display: none;
            }
            .table-row {
                display: flex;
                flex-direction: column;
                padding: 1rem;
                border-bottom: 1px solid #e5e7eb;
            }
            .table-cell {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem 0;
            }
            .table-cell:before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 1rem;
                color: #4b5563;
            }
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
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('supplier.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-clipboard-list w-5 text-center"></i>
                    <span>Orders</span>
                </a>
                <a href="{{ route('supplier.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                    <i class="fas fa-boxes w-5 text-center"></i>
                    <span>Inventory</span>
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
                    <h1 class="text-3xl font-bold text-green-800">Supplier Inventory</h1>
                    <p class="text-gray-600">Manage your product listings and inventory</p>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-file-export mr-2"></i> Export
                    </button>
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center">
                         <!-- Add Product Button (now links to create form) -->
         <a href="{{ route('supplier_inventory.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    
                    </button>
                </div>
            </div>

            <!-- Products Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-500">Total Products</h2>
                            <p class="text-3xl font-bold text-green-700">0</p>
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
                            <p class="text-3xl font-bold text-green-700">0</p>
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
                            <p class="text-3xl font-bold text-yellow-700">0</p>
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
            <table class="min-w-full divide-y divide-gray-200"> <!-- ← Add this line -->
                 <tbody class="bg-white divide-y divide-gray-200">
            <thead>
            <tr>
                <th>Product</th>
                <th>product_id</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Measurements</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
    @forelse ($products as $product)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $product->product }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $product->product_id }}</td>
           <td class="px-6 py-4 whitespace-nowrap">{{ $product->quantity }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $product->unit_price }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $product->measurement }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $product->status }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right">{{ $product->actions}}</td>
                   
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                <div class="flex flex-col items-center justify-center py-12">
                    <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                    
                   
                </div>
            </td>
        </tr>
    @endforelse
</tbody>

                   
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Empty state -->
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-12">
                                        <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                                        
                                    </div>
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
                                Showing <span class="font-medium">0</span> to <span class="font-medium">0</span> of <span class="font-medium">0</span> products
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

    <script>
        // This script would handle the actions dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            // For mobile view, we'll add click handlers to show actions
            const actionButtons = document.querySelectorAll('.actions-btn');
            
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;
                    const allDropdowns = document.querySelectorAll('.actions-dropdown');
                    
                    // Close all other dropdowns
                    allDropdowns.forEach(d => {
                        if (d !== dropdown) d.style.display = 'none';
                    });
                    
                    // Toggle current dropdown
                    if (dropdown.style.display === 'block') {
                        dropdown.style.display = 'none';
                    } else {
                        dropdown.style.display = 'block';
                    }
                });
            });
            
            // Close dropdowns when clicking elsewhere
            document.addEventListener('click', function() {
                document.querySelectorAll('.actions-dropdown').forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
            });
        });
    </script>
</body>
</html>