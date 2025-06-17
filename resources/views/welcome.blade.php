<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('sucham.ico') }}" type="image/x-icon">

    <title>Welcome to SUCHAM</title>
    @vite('resources/css/app.css')
    
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-white shadow-md p-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('sucham.jpg') }}" alt="SUCHAM Logo" class="h-10 w-10 object-contain">
                <h1 class="text-2xl font-bold text-indigo-600">SUCHAM</h1>
            </div>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">Sign Up</a>
                <a href="{{ route('register.supplier') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
                 Register as Supplier
                </a>

            </div>
        </div>
    </header>

    <main class="flex justify-center mt-10 sm:mt-20 mb-10 bg-gray-50 px-4">
        <div class="h-auto sm:h-[400px] flex flex-col sm:flex-row border-4 border-gray-300 rounded-xl p-6 w-full sm:w-4/5 max-w-7xl shadow-lg bg-white">
            
            <div class="w-full sm:w-1/2 pr-0 sm:pr-6 flex flex-col justify-center order-2 sm:order-1 mt-6 sm:mt-0">
                <h1 class="text-3xl sm:text-4xl font-bold mb-4 text-gray-800">Welcome to SUCHAM</h1>
                <p class="text-2xl sm:text-4xl italic mb-3 text-gray-500">"Naturally Sweet"</p>
                <p class="text-base sm:text-lg text-gray-600 mb-4">
                    Efficient supply chain management for sugar suppliers, customers, and administrators.
                </p>
                <a href="/login" class="mt-4 inline-block bg-indigo-600 hover:scale-105 transition-transform text-white font-semibold py-2 px-4 rounded">
                    Get Started
                </a>
                <a href="{{ route('register.supplier') }}" class="mt-2 inline-block bg-white text-black px-4 py-2 rounded border border-black hover:scale-105 transition-transform">
                    Register as Supplier
                </a>

            </div>

            
            <div class="w-full sm:w-1/2 flex items-center justify-center order-1 sm:order-2">
                <img src="{{ asset('coffee-cafe-fabric.jpg') }}" alt="Sugar sacks in warehouse" class="max-w-full h-auto rounded-lg shadow" />
            </div>
        </div>
    </main>

    <footer class="mt-10 sm:mt-20 text-center text-sm text-gray-500 px-4">
        &copy; {{ date('Y') }} SUCHAM. All rights reserved.
    </footer>
</body>
</html>