<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <title>GoldenFields Agro - Support Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Preload assets -->
  <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
  <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">

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
      darkMode: 'class',
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
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif'],
          },
          boxShadow: {
            card: '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02)',
            'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
          },
          transitionProperty: {
            height: 'height',
            spacing: 'margin, padding',
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
    [x-cloak] { display: none !important; }
    .nav-item {
      @apply px-3 py-2 rounded-lg transition-all duration-300 ease-in-out transform hover:-translate-y-0.5;
    }
    .nav-item:hover {
      @apply bg-primary-700/10 shadow-sm;
    }
    .nav-item.active {
      @apply bg-primary-50 text-primary-900 font-semibold shadow-inner;
    }
    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800 font-sans min-h-screen flex flex-col antialiased">
  <!-- Top Navigation Bar -->
  <header class="bg-gradient-to-r from-primary-700 to-primary-900 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <i class="fas fa-leaf text-accent-400 text-2xl animate-float"></i>
        <span class="text-2xl font-bold tracking-tight">
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
            $backUrl = getHomeRouteForRole(auth()->user()->role);
          @endphp
          <a href="{{ $backUrl }}" class="hover:text-accent-300 transition-colors duration-200">GoldenFields</a>
        </span>
      </div>
      <nav class="flex items-center space-x-2">
        <a href="{{ route('support.index') }}" 
           class="nav-item flex items-center space-x-1 bg-white/10 backdrop-blur-sm hover:bg-white/20">
          <i class="fas fa-chart-line"></i>
          <span>Reorders Report</span>
        </a>
      </nav>
    </div>
  </header>

  <!-- Flash Messages -->
  <section class="px-4 py-3 max-w-5xl mx-auto w-full">
    @include('partials.flash')
  </section>

  <!-- Page Content -->
  <main class="flex-1 px-4 py-6 max-w-5xl mx-auto w-full space-y-6">
    <div class="bg-white rounded-xl shadow-card overflow-hidden transition-all duration-300 hover:shadow-card-hover">
      <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <span class="bg-primary-100 text-primary-800 p-2 rounded-lg mr-3">
              <i class="fas fa-box-open"></i>
            </span>
            Reorder Report Log
          </h2>
          
          <a href="#" onclick="goBackAndReload()"
             class="mt-4 md:mt-0 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-all duration-200 flex items-center justify-center space-x-2">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
          </a>
        </div>

        <!-- Filters -->
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 bg-gray-50 p-4 rounded-lg">
          <div class="space-y-1">
            <label class="block text-sm font-medium text-gray-700">Material</label>
            <select name="material_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
              <option value="">All Materials</option>
              @foreach($materials as $mat)
                <option value="{{ $mat }}" {{ request('material_name') === $mat ? 'selected' : '' }}>
                  {{ $mat }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="space-y-1">
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="date" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                   value="{{ request('date') }}">
          </div>

          <div class="flex items-end">
            <button type="submit" 
                    class="w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center justify-center space-x-2">
              <i class="fas fa-filter"></i>
              <span>Apply Filters</span>
            </button>
          </div>
        </form>

        <!-- Table -->
        <div class="border border-gray-200 rounded-lg overflow-hidden">
          <table class="w-full table-auto text-sm">
            <thead class="bg-gray-100">
              <tr class="text-left text-gray-700">
                <th class="px-6 py-3 font-medium">Material</th>
                <th class="px-6 py-3 font-medium">Quantity</th>
                <th class="px-6 py-3 font-medium">Requested By</th>
                <th class="px-6 py-3 font-medium">Requested At</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @forelse($reports as $report)
              <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 font-medium text-primary-700">{{ $report->material_name }}</td>
                <td class="px-6 py-4">{{ $report->quantity_requested }}</td>
                <td class="px-6 py-4">{{ $report->requested_by }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $report->requested_at->format('M d, Y H:i') }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center py-8 text-gray-500">
                  <div class="flex flex-col items-center justify-center space-y-2">
                    <i class="fas fa-inbox text-3xl text-gray-400"></i>
                    <span>No reorders found</span>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 rounded-b-lg">
          {{ $reports->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </main>

  <script>
    function goBackAndReload() {
      window.location = document.referrer || '/';
    }
  </script>

  <!-- Livewire Scripts -->
  @livewireScripts
</body>
</html>