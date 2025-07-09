<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <link rel="icon" href="{{ asset('sucham.ico') }}" type="image/x-icon">

        <title>Chat - GoldenFields</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom CSS to override Laravel colors with GoldenFields theme -->
        <style>
            :root {
                --primary-green: #166534;
                --primary-gold: #fbbf24;
                --primary-black: #1f2937;
                --secondary-green: #14532d;
                --light-green: #dcfce7;
                --dark-green: #052e16;
            }

            /* Override Laravel's default colors for guest pages */
            .bg-gray-100 {
                background: linear-gradient(135deg, var(--light-green) 0%, #f0fdf4 100%) !important;
            }

            .bg-white {
                background-color: white !important;
                border: 1px solid rgba(22, 101, 52, 0.1) !important;
            }

            .text-gray-500 {
                color: var(--primary-green) !important;
            }

            .shadow-md {
                box-shadow: 0 4px 6px -1px rgba(22, 101, 52, 0.1), 0 2px 4px -1px rgba(22, 101, 52, 0.06) !important;
            }

            /* Form styling */
            .form-input {
                border-color: rgba(22, 101, 52, 0.2) !important;
            }

            .form-input:focus {
                border-color: var(--primary-gold) !important;
                box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1) !important;
            }

            /* Button styling */
            .btn-primary {
                background-color: var(--primary-green) !important;
                color: white !important;
                border-color: var(--primary-green) !important;
            }

            .btn-primary:hover {
                background-color: var(--secondary-green) !important;
                border-color: var(--secondary-green) !important;
            }

            .btn-secondary {
                background-color: var(--primary-gold) !important;
                color: var(--primary-black) !important;
                border-color: var(--primary-gold) !important;
            }

            .btn-secondary:hover {
                background-color: #f59e0b !important;
                border-color: #f59e0b !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[whitesmoke]">

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center shadow-md">
                        <img src="{{ asset('sucham.jpg') }}" alt="GoldenFields Logo" class="h-12 w-12 rounded-full">
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-800">GoldenFields</div>
                        <div class="flex items-center">
            <i class="fas fa-comment-dots text-white text-xl"></i>
            <h1 class="text-2xl font-bold text-white ml-3">Chat</h1>
                        </div>
                    </div>
                </a>
                <div class="border-b  bg-primary">
      
    </div>
            </div>

            <div class="w-full lg:w-11/12 xl:w-10/12 mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>


        </div>
    </body>
</html>
