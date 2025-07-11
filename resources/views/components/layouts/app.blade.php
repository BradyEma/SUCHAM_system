<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Chat | GoldenFields Industries Ltd.</title>
        <link rel="icon" href="{{ asset('sucham.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

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

            /* Override Laravel's default colors */
            .bg-primary {
                background-color: var(--primary-green) !important;
            }

            .bg-secondary {
                background-color: var(--primary-gold) !important;
            }

            .text-primary {
                color: var(--primary-green) !important;
            }

            .text-secondary {
                color: var(--primary-gold) !important;
            }

            .border-primary {
                border-color: var(--primary-green) !important;
            }

            .border-secondary {
                border-color: var(--primary-gold) !important;
            }

            /* Navigation styling */
            .bg-white {
                background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%) !important;
            }

            .text-gray-800 {
                color: white !important;
            }

            .text-gray-500 {
                color: var(--primary-gold) !important;
            }

            .text-gray-400 {
                color: #9ca3af !important;
            }

            /* Button styling */
            .bg-blue-600 {
                background-color: var(--primary-green) !important;
            }

            .hover\:bg-blue-700:hover {
                background-color: var(--secondary-green) !important;
            }

            .bg-gray-800 {
                background-color: var(--primary-black) !important;
            }

            .dark\:bg-gray-800 {
                background-color: var(--primary-black) !important;
            }

            .dark\:text-gray-200 {
                color: white !important;
            }

            /* Focus states */
            .focus\:ring-blue-500:focus {
                --tw-ring-color: var(--primary-gold) !important;
            }

            .focus\:border-blue-500:focus {
                border-color: var(--primary-gold) !important;
            }

            /* Shadow styling */
            .shadow {
                box-shadow: 0 1px 3px 0 rgba(22, 101, 52, 0.1), 0 1px 2px 0 rgba(22, 101, 52, 0.06) !important;
            }

            .shadow-sm {
                box-shadow: 0 1px 2px 0 rgba(22, 101, 52, 0.05) !important;
            }

            /* Background colors */
            .bg-gray-100 {
                background-color: var(--light-green) !important;
            }

            .dark\:bg-gray-900 {
                background-color: var(--dark-green) !important;
            }

            /* Border colors */
            .border-gray-100 {
                border-color: rgba(22, 101, 52, 0.1) !important;
            }

            .border-gray-200 {
                border-color: rgba(22, 101, 52, 0.2) !important;
            }

            .dark\:border-gray-700 {
                border-color: rgba(251, 191, 36, 0.2) !important;
            }

            /* Text colors */
            .text-gray-900 {
                color: var(--primary-black) !important;
            }

            .dark\:text-gray-100 {
                color: white !important;
            }

            /* Hover states */
            .hover\:text-gray-700:hover {
                color: var(--primary-green) !important;
            }

            .hover\:bg-gray-100:hover {
                background-color: var(--light-green) !important;
            }

            .dark\:hover\:bg-gray-900:hover {
                background-color: var(--dark-green) !important;
            }

            /* Navigation component overrides */
            .nav-link {
                color: white !important;
                transition: color 0.3s ease;
            }

            .nav-link:hover {
                color: var(--primary-gold) !important;
            }

            .nav-link.active {
                color: var(--primary-gold) !important;
                font-weight: 600;
            }

            /* Dropdown styling */
            .dropdown-content {
                background-color: white !important;
                border: 1px solid rgba(22, 101, 52, 0.2) !important;
                box-shadow: 0 4px 6px -1px rgba(22, 101, 52, 0.1) !important;
            }

            .dropdown-link {
                color: var(--primary-green) !important;
                transition: background-color 0.3s ease;
            }

            .dropdown-link:hover {
                background-color: var(--light-green) !important;
            }

            /* Responsive nav links */
            .responsive-nav-link {
                color: white !important;
                transition: color 0.3s ease;
            }

            .responsive-nav-link:hover {
                color: var(--primary-gold) !important;
            }

            .responsive-nav-link.active {
                color: var(--primary-gold) !important;
                background-color: rgba(251, 191, 36, 0.1) !important;
            }

            /* Button overrides */
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

            /* Form elements */
            .form-input:focus {
                border-color: var(--primary-gold) !important;
                box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1) !important;
            }

            .form-select:focus {
                border-color: var(--primary-gold) !important;
                box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1) !important;
            }

            /* Alert styling */
            .alert-success {
                background-color: var(--light-green) !important;
                border-color: var(--primary-green) !important;
                color: var(--primary-green) !important;
            }

            .alert-error {
                background-color: #fef2f2 !important;
                border-color: #dc2626 !important;
                color: #dc2626 !important;
            }

            .alert-warning {
                background-color: #fffbeb !important;
                border-color: var(--primary-gold) !important;
                color: #92400e !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('components.layouts.navigation')

            <!-- Page Heading -->
            @isset($header) 
            @stack('navbar')

                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            @livewireScripts
        </div>
    </body>
</html>
