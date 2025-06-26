<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | GoldenFields</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .bg-pattern {
            background-image: radial-gradient(circle at 25% 25%, rgba(34, 197, 94, 0.1) 0%, transparent 50%), 
                            radial-gradient(circle at 75% 75%, rgba(234, 179, 8, 0.1) 0%, transparent 50%);
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px green;
            border-color: green;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #b7791f;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-primary-700 to-primary-900 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Background pattern -->
    <div class="absolute inset-0 bg-pattern z-0"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-green-700 rounded-full opacity-10 mix-blend-overlay"></div>
    <div class="absolute -top-20 -left-20 w-64 h-64 bg-yellow-500 rounded-full opacity-10 mix-blend-overlay"></div>
    
    <!-- Sugar cane leaf pattern -->
    <div class="absolute inset-0 opacity-5 z-0" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\" fill=\"%23ffffff\"><path d=\"M50 0 Q60 30 50 60 Q40 90 50 100 Q60 90 50 60 Q40 30 50 0\" /></svg>'); background-size: 200px;"></div>

    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden z-10 transform hover:shadow-lg transition duration-300">
        <!-- Header section with gradient -->
        <div class="bg-gradient-to-r from-primary-700 to-primary-800 p-8 text-center">
            <div class="flex justify-center mb-4">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-md border-4 border-yellow-400">
                    <img src="{{ asset('goldenfields.png') }}" alt="GoldenFields Logo" class="h-12 w-12 rounded-full">
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>
            <p class="text-primary-200">Login to your GoldenFields account</p>
        </div>

        <!-- Login form -->
        <div class="p-8">
            @if (session('status'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-green-800"></i>
                        </div>
                        <input id="email" name="email" type="email" required autofocus
                               class="pl-10 input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" 
                               placeholder="your@email.com">
                    </div>
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-green-800"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                               class="pl-10 input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" 
                               >
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="far fa-eye text-green-800"></i>
                        </span>
                    </div>
                </div>

                <!-- Remember me & Forgot password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-yellow-600 hover:text-yellow-700 hover:underline">
                        Forgot Password?
                    </a>
                </div>

                <!-- Submit button -->
                <button type="submit" class="w-full bg-gradient-to-r from-green-700 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>

                <!-- Register link -->
                <div class="text-center pt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium text-primary-700 hover:text-primary-800 hover:underline">
                            Create one
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="bg-primary-50 px-8 py-4 text-center border-t border-gray-200">
            <p class="text-xs text-primary-600">
                &copy; {{ date('Y') }} GoldenFields Agro Industries. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>