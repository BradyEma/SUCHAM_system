<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Your Role | GoldenFields</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .role-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        .role-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        input[type="radio"]:checked + .role-card {
            border-color: #FFD700;
            background-color: #f0fdf4;
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.2);
        }
        .bg-pattern {
            background-image: radial-gradient(circle at 25% 25%, rgba(34, 197, 94, 0.1) 0%, transparent 50%),
                              radial-gradient(circle at 75% 75%, rgba(234, 179, 8, 0.1) 0%, transparent 50%);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-800 via-green-700 to-green-600 flex items-center justify-center p-4 relative overflow-y-auto">

    <!-- Decorative elements -->
    <div class="absolute inset-0 bg-pattern z-0"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-green-700 rounded-full opacity-10 mix-blend-overlay"></div>
    <div class="absolute -top-20 -left-20 w-64 h-64 bg-yellow-500 rounded-full opacity-10 mix-blend-overlay"></div>
    
    <!-- Sugar cane leaf pattern -->
    <div class="absolute inset-0 opacity-5 z-0" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot; fill=&quot;%23ffffff&quot;><path d=&quot;M50 0 Q60 30 50 60 Q40 90 50 100 Q60 90 50 60 Q40 30 50 0&quot; /></svg>'); background-size: 200px;"></div>

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-2xl overflow-hidden z-10 transform hover:shadow-lg transition duration-300 max-h-full">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-700 via-green-600 to-green-500 p-8 text-center relative">
            <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot; fill=&quot;%23ffffff&quot;><circle cx=&quot;25&quot; cy=&quot;25&quot; r=&quot;3&quot; /><circle cx=&quot;75&quot; cy=&quot;25&quot; r=&quot;3&quot; /><circle cx=&quot;25&quot; cy=&quot;75&quot; r=&quot;3&quot; /><circle cx=&quot;75&quot; cy=&quot;75&quot; r=&quot;3&quot; /></svg>'); background-size: 40px;"></div>
            <div class="relative z-10">
                <div class="flex justify-center mb-4">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-md border-4 border-yellow-400">
                        <img src="{{ asset('sucham.jpg') }}" alt="GoldenFields Logo" class="h-14 w-14 rounded-full">
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Join GoldenFields Network</h1>
                <p class="text-green-100">Select your role to continue registration</p>
            </div>
        </div>

        <!-- Role selection cards -->
        <div class="p-8 bg-white">
            <form method="POST" action="{{ route('choose.role.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Supplier Card -->
                    <label class="block">
                        <input type="radio" name="role" value="supplier" class="hidden" required>
                        <div class="role-card border-l-green-500 h-full p-6 rounded-lg border border-gray-200 cursor-pointer bg-gradient-to-br from-white to-green-50">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-3 rounded-full mr-4 text-green-700">
                                    <i class="fas fa-tractor text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">Supplier</h3>
                                    <p class="text-gray-600 text-sm">Sugar producers, farmers, and manufacturers</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Wholesaler Card -->
                    <label class="block">
                        <input type="radio" name="role" value="wholesaler" class="hidden">
                        <div class="role-card border-l-green-400 h-full p-6 rounded-lg border border-gray-200 cursor-pointer bg-gradient-to-br from-white to-green-50">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-3 rounded-full mr-4 text-green-700">
                                    <i class="fas fa-warehouse text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">Wholesaler</h3>
                                    <p class="text-gray-600 text-sm">Bulk buyers and distributors</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Retailer Card -->
                    <label class="block">
                        <input type="radio" name="role" value="retailer" class="hidden">
                        <div class="role-card border-l-yellow-500 h-full p-6 rounded-lg border border-gray-200 cursor-pointer bg-gradient-to-br from-white to-yellow-50">
                            <div class="flex items-start">
                                <div class="bg-yellow-100 p-3 rounded-full mr-4 text-yellow-700">
                                    <i class="fas fa-store text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">Retailer</h3>
                                    <p class="text-gray-600 text-sm">Shops and small-scale sellers</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Customer Card -->
                    <label class="block">
                        <input type="radio" name="role" value="customer" class="hidden">
                        <div class="role-card border-l-green-300 h-full p-6 rounded-lg border border-gray-200 cursor-pointer bg-gradient-to-br from-white to-green-50">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-3 rounded-full mr-4 text-green-700">
                                    <i class="fas fa-user-tie text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">Industrial Customer</h3>
                                    <p class="text-gray-600 text-sm">Food manufacturers and processors</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                    Continue <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="bg-green-50 px-8 py-4 text-center border-t border-green-200">
            <p class="text-sm text-green-700">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-green-800 hover:text-green-900 hover:underline">
                    Sign in here
                </a>
            </p>
            <p class="text-xs text-green-600 mt-2">
                &copy; {{ date('Y') }} GoldenFields Agro Industries. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        // Highlight selected card visually
        document.querySelectorAll('input[name="role"]').forEach(radio => {
            radio.addEventListener('change', function () {
                document.querySelectorAll('.role-card').forEach(card => {
                    card.classList.remove('selected');
                });
                if (this.checked) {
                    this.nextElementSibling.classList.add('selected');
                }
            });
        });
    </script>
</body>
</html>
