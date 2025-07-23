<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Wholesaler Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .profile-header {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
        }
        .btn-primary {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
        }
        .status-badge {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .input-focus:focus {
            border-color: #d97706;
            box-shadow: 0 0 0 3px rgba(214, 158, 46, 0.2);
        }
        .sidebar {
             background: #166534;
        }
        .nav-item {
            transition: all 0.2s ease;
        }
         .nav-item:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }
        .nav-item.active {
            background-color: #f0fdf4;
            color: #14532d;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar text-white w-64 flex-shrink-0 hidden md:flex md:flex-col">
            <div class="flex items-center justify-center p-6 border-b border-yellow-500">
                <div class="flex items-center">
                    <i class="fas fa-store-alt text-yellow-400 text-2xl mr-3"></i>
                    <span class="text-xl font-bold">GoldenFields</span>
                </div>
            </div>
            <div class="flex-grow p-4 overflow-y-auto">
                <nav class="space-y-1">
                    <a href="{{ route('wholesaler.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('wholesaler.inventory.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-boxes mr-3"></i>
                        Inventory
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Orders
                        <span class="ml-auto bg-yellow-500 text-black text-xs px-2 py-1 rounded-full">3</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-truck mr-3"></i>
                        Deliveries
                    </a>
                   
                    <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-comments mr-3"></i>
                        Messages
                        <span class="ml-auto bg-yellow-500 text-black text-xs px-2 py-1 rounded-full">5</span>
                    </a>
                    <a href="{{ route('support.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-question-circle w-5 text-center"></i>
                        <span>Support Center</span>
                    </a>
                    <a href="{{ route('wholesaler.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                        <i class="fas fa-user-circle mr-3"></i>
                        Profile
                    </a>
                </nav>
                
                
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <nav class="bg-white shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center md:hidden">
                            <button class="text-gray-500 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                        </div>
                        <div class="flex items-center bg-red">
                            <div class="flex-shrink-0 flex items-center md:hidden">
                                <i class="fas fa-store-alt text-yellow-500 text-2xl mr-2"></i>
                                <span class="text-xl font-bold text-red-800">GoldenFields</span>
                            </div>
                         <div class="ml-4 inline-flex items-center bg-gray-100 rounded-full px-4 py-2">
    <i class="fas fa-user-circle text-yellow-500 mr-2"></i>
    <span class="text-gray-700 font-medium">Mr/Mrs. {{ $user->name }}</span>
</div>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <button class="p-1 rounded-full text--400 hover:text-gray-500 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                               
                            </button>
                             
                            <div class="ml-3 relative">
                                <div>
                                    <button class="flex text-sm rounded-full focus:outline-none" id="user-menu">
                                        <img class="h-8 w-8 rounded-full" 
     src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}" 
     alt="User profile">

                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Profile Header -->
        <div class="profile-header rounded-xl shadow-lg p-6 text-white mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Wholesaler Profile</h1>
                    <p class="mt-1 opacity-90">Manage your business information and settings</p>
                </div>
                <div class="mt-4 md:mt-0">
                    @if ($wholesaler)
                    <span class="status-badge px-3 py-1 rounded-full text-sm font-medium {{ $wholesaler->status === 'approved' ? 'bg-green-100 text-green-800' : ($wholesaler->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                        @if ($wholesaler->status === 'approved')
                            <i class="fas fa-check-circle mr-1"></i> Approved
                        @elseif ($wholesaler->status === 'pending')
                            <i class="fas fa-clock mr-1"></i> Pending Approval
                        @else
                            <i class="fas fa-question-circle mr-1"></i> Unknown Status
                        @endif
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile Picture Upload Section -->
<div class="mt-10 bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Update Profile Picture</h2>

    @if(session('profile_success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('profile_success') }}
        </div>
    @endif

    @if(auth()->user()->profile_picture)
        <div class="mb-4">
            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture"
                 class="w-32 h-32 rounded-full object-cover border border-gray-300 shadow">
        </div>
    @endif

    <form action="{{ route('wholesaler.profile-picture.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Choose New Profile Picture</label>
            <input type="file" name="profile_picture"
                   class="border border-gray-300 rounded px-3 py-2 w-full @error('profile_picture') border-red-500 @enderror">
            @error('profile_picture')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
            Update Picture
        </button>
    </form>
</div>


        <!-- Current Profile Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 mb-8">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-info-circle text-yellow-500 mr-2"></i>
                    Current Business Information
                </h2>
            </div>
            <div class="p-6">
                @if ($wholesaler)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Business Name</p>
                            <p class="mt-1 text-gray-900 font-medium">{{ $wholesaler->business_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Phone Number</p>
                            <p class="mt-1 text-gray-900 font-medium">{{ $wholesaler->phone }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Location</p>
                            <p class="mt-1 text-gray-900 font-medium">{{ $wholesaler->location }}</p>
                        </div>
                        @if($wholesaler->tin)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tax Identification Number (TIN)</p>
                            <p class="mt-1 text-gray-900 font-medium">{{ $wholesaler->tin }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <p class="text-gray-500">No profile information available yet. Please complete the form below.</p>
                @endif
            </div>
        </div>

        <!-- Business Info Form -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-edit text-yellow-500 mr-2"></i>
                    Update Business Information
                </h2>
            </div>
            <form method="POST" action="{{ route('wholesaler.profile.store') }}" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Business Name *</label>
                        <input type="text" name="business_name" required 
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg input-focus focus:outline-none" 
                            value="{{ old('business_name', $wholesaler->business_name ?? '') }}"
                            placeholder="Enter your business name">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                        <input type="text" name="phone" required 
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg input-focus focus:outline-none" 
                            value="{{ old('phone', $wholesaler->phone ?? '') }}"
                            placeholder="Enter phone number">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                        <input type="text" name="location" required 
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg input-focus focus:outline-none" 
                            value="{{ old('location', $wholesaler->location ?? '') }}"
                            placeholder="Enter business location">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tax ID (TIN)</label>
                        <input type="text" name="tin" 
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg input-focus focus:outline-none" 
                            value="{{ old('tin', $wholesaler->tin ?? '') }}"
                            placeholder="Enter TIN if available">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Business Certificate (PDF only)</label>
                        <div class="mt-1 flex items-center">
                            <label class="cursor-pointer">
                                <span class="btn-primary text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                                    <i class="fas fa-upload mr-2"></i> Choose File
                                </span>
                                <input type="file" name="document" accept="application/pdf" class="hidden">
                            </label>
                            <span class="ml-3 text-sm text-gray-500" id="file-name">No file chosen</span>
                        </div>
                        @if($wholesaler && $wholesaler->document_path)
                        <p class="mt-2 text-sm text-green-600">
                            <i class="fas fa-check-circle mr-1"></i> Document already uploaded
                        </p>
                        @endif
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-medium shadow-md hover:shadow-lg transition-all flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Profile
                    </button>
                </div>
            </form>
        </div>

        <!-- Logout Section -->
        <div class="mt-8 bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
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
    </div>
</div>
        </div>
    </div>
     
                    
               
    
    <script>
        // Show selected file name
        document.querySelector('input[name="document"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });

       

        // Mobile menu toggle (placeholder - implement as needed)
        document.querySelector('.md\\:hidden button').addEventListener('click', function() {
            // Implement mobile menu toggle functionality here
            console.log('Mobile menu clicked');
        });
    </script>
</body>
</html>