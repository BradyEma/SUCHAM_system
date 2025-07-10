<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Profile | GoldenFields</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    <div class="flex h-screen overflow-hidden">
        <!-- Retailer Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-primary-800 text-white">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-leaf text-secondary-400 text-xl"></i>
                        <span class="text-xl font-bold">GoldenFields</span>
                        <span class="bg-secondary-500 text-white text-xs px-2 py-1 rounded-full ml-2">RETAILER</span>
                    </div>
                </div>
                
                <!-- Retailer Profile Summary -->
                <div class="p-4 border-b border-primary-700 flex items-center space-x-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Retailer" class="h-10 w-10 rounded-full border-2 border-secondary-400">
                    <div>
                        <p class="font-medium">Retailer Name</p>
                        <p class="text-xs text-primary-200">Verified Account</p>
                    </div>
                </div>
                
                <!-- Main Navigation -->
                <div class="flex-1 overflow-y-auto py-4">
                    <nav class="px-2 space-y-1">
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        <a href="#" class="bg-primary-700 text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-user-circle mr-3"></i>
                            My Profile
                        </a>
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-boxes mr-3"></i>
                            My Products
                        </a>
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            Orders
                        </a>
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-chart-line mr-3"></i>
                            Sales Analytics
                        </a>
                    </nav>
                </div>
                
                <!-- Logout -->
                <div class="p-4 border-t border-primary-700">
                    <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-secondary-600 hover:bg-secondary-700">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button type="button" class="md:hidden text-gray-500 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold text-gray-800">Retailer Profile</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none relative">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                        <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-question-circle"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Profile Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Business Profile</h2>
                        <p class="text-gray-600">Update your retailer information and documents</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Verified Retailer
                        </span>
                    </div>
                </div>

                <!-- Profile Form -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-primary-600 to-primary-800 px-6 py-4 text-white">
                        <h3 class="text-lg font-semibold">
                            <i class="fas fa-store mr-2"></i> Business Information
                        </h3>
                    </div>
                    
                    <form action="{{ route('retailer.profile.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf

                        <!-- Success/Error Messages -->
                        @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-sm font-medium text-green-800">{{ session('success') }}</span>
                            </div>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-red-800">There were {{ count($errors) }} errors with your submission</h4>
                                    <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Business Name -->
                            <div>
                                <label for="business_name" class="block text-sm font-medium text-gray-700 mb-1">Business Name *</label>
                                <input type="text" id="business_name" name="business_name" 
                                    value="{{ old('business_name', $retailer->business_name ?? '') }}"
                                    class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                    required placeholder="Enter your business name">
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                                <input type="text" id="location" name="location" 
                                    value="{{ old('location', $retailer->location ?? '') }}"
                                    class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                    required placeholder="Business location">
                            </div>

                            <!-- Contact Number -->
                            <div>
                                <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-1">Contact Number *</label>
                                <input type="text" id="contact_number" name="contact_number" 
                                    value="{{ old('contact_number', $retailer->contact_number ?? '') }}"
                                    class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                    required placeholder="Phone number">
                            </div>

                            <!-- TIN -->
                            <div>
                                <label for="tin" class="block text-sm font-medium text-gray-700 mb-1">Tax Identification Number (TIN)</label>
                                <input type="text" id="tin" name="tin" 
                                    value="{{ old('tin', $retailer->tin ?? '') }}"
                                    class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Enter TIN if available">
                            </div>

                            <!-- Document Upload -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Business Certificate (PDF only)</label>
                                <div class="mt-1 flex items-center">
                                    <span class="inline-block h-12 w-12 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-file-pdf text-gray-400 text-xl"></i>
                                    </span>
                                    <label class="ml-5 cursor-pointer">
                                        <span class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 inline-flex items-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            <i class="fas fa-upload mr-2"></i> Choose File
                                        </span>
                                        <input type="file" name="document" accept="application/pdf" class="sr-only">
                                    </label>
                                    <span class="ml-3 text-sm text-gray-500" id="file-name">
                                        @if($retailer && $retailer->document_path)
                                            Current file uploaded
                                        @else
                                            No file chosen
                                        @endif
                                    </span>
                                </div>
                                @if($retailer && $retailer->document_path)
                                <p class="mt-2 text-sm text-green-600">
                                    <i class="fas fa-check-circle mr-1"></i> Document already uploaded
                                </p>
                                @endif
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end pt-6 mt-6 border-t border-gray-200">
                            <button type="reset" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i class="fas fa-save mr-2"></i> Save Profile
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Update file name display when file is selected
        document.querySelector('input[name="document"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>
</html>