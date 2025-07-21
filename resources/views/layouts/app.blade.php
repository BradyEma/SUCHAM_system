<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <title>GoldenFields Agro - Support Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Tailwind via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Tailwind Custom Config -->
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
            accent: {
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
            },
          },
        },
      },
    };
  </script>

  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Livewire Styles -->
  @livewireStyles

  <style>
    .nav-item:hover {
      background-color: rgba(255, 215, 0, 0.1);
    }
    .nav-item.active {
      background-color: #f0fdf4;
      color: #14532d;
      font-weight: 600;
    }
  </style>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
  <!-- Top Navigation Bar -->
  <header class="bg-primary-800 text-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <i class="fas fa-leaf text-accent-400 text-xl"></i>
        <span class="text-2xl font-bold">
            @php
                function getHomeRouteForRole($role) {
                      return match($role) {
                          'admin' => route('admin.dashboard'),
                          'supplier' => route('supplier.dashboard'),
                          'wholesaler' => route('wholesaler.dashboard'),
                          'retailer' => route('retailer.dashboard'),
                          'customer' => route('customer.dashboard'),
                          default => '/',
                      };
                  }

            // Get the back URL based on the authenticated user's role    

                  $backUrl = getHomeRouteForRole(auth()->user()->role);

            @endphp
            <a href="{{ $backUrl }}">GoldenFields</a>
        </span>
      </div>
      <nav class="space-x-4">
        <a href="{{ route('support.index') }}" class="nav-item px-3 py-2 rounded transition-all duration-200 hover:bg-primary-700">
          Support Center
        </a>
        <!-- Add more nav links here -->
      </nav>
    </div>
  </header>

  <!-- Flash Messages -->
  <section class="px-4 py-4 max-w-4xl mx-auto w-full">
    @include('partials.flash')
  </section>

  <!-- Page Content -->
  <main class="flex-1 px-6 py-6 max-w-4xl mx-auto w-full space-y-6">
    @yield('content')

    <!-- Navigation Buttons -->
    <div class="flex justify-between mt-6">
        <a href="{{ $backUrl }}"
           class="px-5 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded transition-all duration-200">
            Home
        </a>
        <a href="javascript:history.back()"
           class="px-5 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded transition-all duration-200">
            ← Back
        </a>
    </div>
  </main>

  <!-- Livewire Scripts -->
  @livewireScripts

</body>
</html>