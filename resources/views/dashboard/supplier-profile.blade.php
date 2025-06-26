<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - GoldenFields Supplier Dashboard</title>
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
        .profile-card {
            transition: all 0.3s ease;
            border-left: 4px solid #22c55e;
        }
        .danger-zone {
            border-left: 4px solid #ef4444;
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
                <a href="{{ route('supplier.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-boxes w-5 text-center"></i>
                    <span>Products</span>
                </a>
               
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-comment-dots w-5 text-center"></i>
                    <span>Chat</span>
                </a>
                <a href="{{ route('supplier.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                    <i class="fas fa-user w-5 text-center"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-green-800">Supplier Profile</h1>
                    <p class="text-gray-600">Manage your GoldenFields account information and settings</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Profile Card -->
                <div class="profile-card bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <img class="h-32 w-32 rounded-full object-cover border-4 border-yellow-400" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Supplier photo">
                            <button class="absolute bottom-0 right-0 bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Sweet Harvest Ltd</h2>
                        <p class="text-gray-600 mb-4">Sugar Cane & Honey Supplier</p>
                        <div class="flex space-x-4 mb-6">
                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-envelope mr-2"></i>Message
                            </button>
                            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg">
                                <i class="fas fa-phone mr-2"></i>Call
                            </button>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Supplier Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-user text-gray-500 mr-3 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Contact Person</p>
                                    <p class="font-medium">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-gray-500 mr-3 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone text-gray-500 mr-3 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-medium">+256 *** **** **</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-gray-500 mr-3 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="font-medium">Kampala, Uganda</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-briefcase text-gray-500 mr-3 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Business Since</p>
                                    <p class="font-medium">2015</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 lg:col-span-2">
                    <h2 class="text-xl font-semibold text-green-800 mb-6">Account Settings</h2>
                    
                    <div class="space-y-6">
                                             

                        <!-- Business Information -->
                       <form method="POST" action="{{ route('supplier.profile.store') }}" enctype="multipart/form-data">


                            @csrf
                            @method('POST') {{-- Use PUT if you're updating an existing record --}}
    
                          <h3 class="text-lg font-medium text-gray-800 mb-4">Business Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="md:col-span-2">
            <label for="business_name" class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
            <input type="text" name="business_name" id="business_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
        <label for="telNo">Telephone Number</label>
         <input type="tel" id="telNo" name="telNo" placeholder="+256701234567" class="border rounded px-3 py-2" required>
         </div>

        <div>
            <label for="business_type" class="block text-sm font-medium text-gray-700 mb-1">Business Type</label>
            <select name="business_type" id="business_type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
                <option value="Sugar Cane Supplier">Sugar Cane Supplier</option>
                <option value="Honey Supplier">Honey Supplier</option>
                <option value="Sugar Cane & Honey Supplier" selected>Sugar Cane & Honey Supplier</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div>
            <label for="Tax_ID" class="block text-sm font-medium text-gray-700 mb-1">Tax ID</label>
            <input type="text" name="Tax_ID" id="Tax_ID" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div class="md:col-span-2">
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Business Address</label>
            <textarea name="location" id="location" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required></textarea>
        </div>

        <div class="md:col-span-2">
            <label for="tin" class="block text-sm font-medium text-gray-700 mb-1">TIN</label>
            <input type="text" name="tin" id="tin" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div class="md:col-span-2">
            <label for="document" class="block text-sm font-medium text-gray-700 mb-1">Upload Certificate or License (PDF)</label>
            <input type="file" name="document" id="document" accept="application/pdf" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="md:col-span-2 text-right mt-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded">
                Save Business Info
            </button>
        </div>
    </div>
</form>


                        <!-- Password Change -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Change Password</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                </div>
                                <div class="flex justify-end pt-4">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg" type="submit">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Preferences -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Notification Preferences</h3>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input type="checkbox" id="order-notifications" checked class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded">
                                    <label for="order-notifications" class="ml-2 block text-sm text-gray-700">New order notifications</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="message-notifications" checked class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded">
                                    <label for="message-notifications" class="ml-2 block text-sm text-gray-700">Message notifications</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="promo-notifications" class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded">
                                    <label for="promo-notifications" class="ml-2 block text-sm text-gray-700">Promotional offers</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="system-notifications" checked class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded">
                                    <label for="system-notifications" class="ml-2 block text-sm text-gray-700">System updates</label>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                                Cancel
                            </button>
                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="danger-zone bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                <h2 class="text-xl font-semibold text-red-600 mb-4">Danger Zone</h2>
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="font-medium text-gray-800">Delete Account</h3>
                        <p class="text-sm text-gray-600">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                    <button class="mt-3 md:mt-0 bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200">
                        Delete Account
                    </button>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="font-medium text-gray-800">Log Out</h3>
                        <p class="text-sm text-gray-600">Sign out of your account on this device</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3 md:mt-0">
                        @csrf
                        <button type="submit" class="flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>