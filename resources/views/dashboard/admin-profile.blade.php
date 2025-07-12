<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile | GoldenFields</title>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
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
<body class="bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Admin Profile</h1>
            <div class="flex items-center space-x-4">
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    Admin Account
                </span>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    Verified
                </span>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="md:flex">
                <!-- Profile Picture Section -->
                <div class="md:w-1/3 p-8 bg-gradient-to-br from-primary-100 to-primary-50 flex flex-col items-center">
                    <div class="relative mb-6">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                                 alt="Profile Picture"
                                 class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-40 h-40 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-5xl font-bold shadow-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="absolute bottom-4 right-4 bg-green-500 rounded-full p-1.5 shadow-sm border-2 border-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.uploadProfilePicture') }}" method="POST" enctype="multipart/form-data" class="w-full">
                        @csrf
                        <label class="block mb-2 text-sm font-medium text-gray-700 text-center">Update Profile Photo</label>
                        <div class="flex flex-col space-y-2">
                            <input type="file" name="profile_picture" 
                                   class="block w-full text-sm text-gray-600 bg-white rounded-lg border border-gray-300 cursor-pointer focus:outline-none">
                            <button type="submit" 
                                    class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 transition-colors">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Profile Details Section -->
                <div class="md:w-2/3 p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Personal Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Full Name</p>
                            <p class="text-gray-800 font-medium">{{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email Address</p>
                            <p class="text-gray-800 font-medium">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Phone Number</p>
                            <p class="text-gray-800 font-medium">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Account Type</p>
                            <p class="text-gray-800 font-medium">GoldenFields Administrator</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Member Since</p>
                            <p class="text-gray-800 font-medium">{{ auth()->user()->created_at ? auth()->user()->created_at->format('F d, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Last Login</p>
                            <p class="text-gray-800 font-medium">{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->diffForHumans() : 'Never' }}</p>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Security</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800">Password</p>
                                <p class="text-sm text-gray-500">Last changed 3 months ago</p>
                            </div>
                            <button class="px-4 py-2 text-sm font-medium text-primary-600 hover:text-primary-800">
                                Change Password
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800">Two-Factor Authentication</p>
                                <p class="text-sm text-gray-500">Add an extra layer of security</p>
                            </div>
                            <button class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700">
                                Enable 2FA
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <button class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Cancel
                </button>
                <button class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Save Changes
                </button>
            </div>
             
            <div class="p-4 ">
        <a  href="
            @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                {{ route('admin.dashboard') }}
            @elseif(\Illuminate\Support\Facades\Auth::user()->role === 'supplier')
                {{ route('supplier.dashboard') }}
            @elseif(\Illuminate\Support\Facades\Auth::user()->role === 'retailer')
                {{ route('retailer.dashboard') }}
            @elseif(\Illuminate\Support\Facades\Auth::user()->role === 'wholesaler')
                {{ route('wholesaler.dashboard') }}
            @else
                {{ route('home') }}
            @endif
        " >
            <button
                class="w-full flex items-center justify-center px-4 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-secondary-700">
                <i class="fas fa-arrow-left mr-2"></i> Exit To Dashboard
            </button>
        </a>
    
</div>

            <div class="p-4 ">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center justify-center px-4 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-yellow-600 hover:bg-secondary-700">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
    </form>
</div>
                    </nav>
                </div>
                      
        </div>
    </div>
</body>
</html>