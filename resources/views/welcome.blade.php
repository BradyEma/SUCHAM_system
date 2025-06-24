<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields Industries - Premium Sugar Products Supply Chain</title>
    <meta name="description" content="GoldenFields Industries connects sugar producers with markets through our efficient, transparent supply chain network. Quality sugar products from farm to industry.">
    <link rel="icon" href="{{ asset('sucham.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
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
                            
                        },
                        gold: '#FFD700',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-amber-50 text-gray-800 min-h-screen flex flex-col font-sans">

    <!-- Header -->
    <header class="bg-primary-900 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('sucham.jpg') }}" alt="GoldenFields Logo" class="h-12 w-12 rounded-full border-2 border-white">
                    <div>
                        <h1 class="text-2xl text-gold font-bold">GoldenFields</h1>
                        <p class="text-xs text-primary-200">Industries Ltd.</p>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-primary-100 hover:text-white font-medium transition">Dashboard</a>
                    <a href="#about" class="text-primary-100 hover:text-white font-medium transition">About Us</a>
                    <a href="#services" class="text-primary-100 hover:text-white font-medium transition">Services</a>
                    <a href="#products" class="text-primary-100 hover:text-white font-medium transition">Products</a>
                    <a href="#contact" class="text-primary-100 hover:text-white font-medium transition">Contact</a>
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="bg-white hover:bg-secondary-600 text-primary-800 px-4 py-2 rounded-md font-medium transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-gold hover:bg-secondary-600 text-black px-4 py-2 rounded-md font-medium transition">Sign Up</a>
                    </div>
                </nav>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-white focus:outline-none" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div class="md:hidden hidden bg-primary-700 px-4 py-2" id="mobile-menu">
            <div class="flex flex-col space-y-3 pb-3">
                <a href="#home" class="text-white px-3 py-2 rounded-md font-medium">Dashboard</a>
                <a href="#about" class="text-white px-3 py-2 rounded-md font-medium">About Us</a>
                <a href="#services" class="text-white px-3 py-2 rounded-md font-medium">Services</a>
                <a href="#products" class="text-white px-3 py-2 rounded-md font-medium">Products</a>
                <a href="#contact" class="text-white px-3 py-2 rounded-md font-medium">Contact</a>
                <div class="flex flex-col space-y-2 pt-2 border-t border-primary-600">
                    <a href="{{ route('login') }}" class="text-center bg-primary-600 text-white px-4 py-2 rounded-md font-medium">Login</a>
                    <a href="{{ route('register') }}" class="text-center bg-yellow-500 text-white px-4 py-2 rounded-md font-medium">Sign Up</a>
                    <a href="{{ route('register') }}" class="text-center bg-white text-primary-800 px-4 py-2 rounded-md font-medium border border-primary-300">
                        Supplier Registration
                    </a>
                </div>
            </div>
        </div>
    </header>

    
   <!-- Hero Section -->
<section id="home" class="relative bg-gradient-to-br from-primary-800 to-primary-900 text-white overflow-hidden">
    <!-- Decorative background -->
    <div class="absolute inset-0 overflow-hidden z-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjAzKSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==')] opacity-20"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-gold rounded-full opacity-10 mix-blend-overlay"></div>
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-white rounded-full opacity-5 mix-blend-overlay"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-24 md:py-32 relative z-10 animate-fade-in">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <!-- Text Content -->
            <div class="md:w-1/2 animate-slide-in-left">
                <div class="mb-6">
                    <span class="inline-block bg-gold text-black px-4 py-1 rounded-full text-sm font-semibold mb-4 shadow-md tracking-wide">
                        Your Premium Sugar Solutions
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                        <span class="text-white">GoldenFields</span>
                        <span class="text-gold">Supply Chain</span>
                        <span class="text-white">Excellence</span>
                    </h1>
                    <p class="text-base sm:text-lg text-primary-100 mb-8 max-w-xl">
                        Connecting sugar producers with global markets through our efficient, transparent supply chain network. Quality products from farm to industry.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                           class="bg-gold hover:bg-yellow-500 text-black px-8 py-4 rounded-md font-semibold text-lg shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                            Join Our Network <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                        <a href="#services"
                           class="bg-transparent border-2 border-white hover:bg-white hover:text-primary-900 text-white px-8 py-4 rounded-md font-semibold text-lg transition-all duration-300 flex items-center justify-center">
                            Explore Services <i class="fas fa-chevron-down ml-3"></i>
                        </a>
                    </div>
                </div>

                <div class="mt-12 flex items-center space-x-6">
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-full bg-primary-700 flex items-center justify-center border border-primary-500 shadow-md">
                            <i class="fas fa-check text-gold"></i>
                        </div>
                        <span class="text-sm font-medium">Certified Quality</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-full bg-primary-700 flex items-center justify-center border border-primary-500 shadow-md">
                            <i class="fas fa-globe text-gold"></i>
                        </div>
                        <span class="text-sm font-medium">Global Network</span>
                    </div>
                </div>
            </div>

            <!-- Image Content -->
            <div class="md:w-1/2 mt-10 md:mt-0 relative rounded-xl shadow-lg animate-slide-in-right">
                <div class="relative">
                    <img src="{{ asset('cane fields.png') }}"
                         alt="Sugar cane field"
                         class="rounded-xl shadow-2xl w-full object-cover border-4 border-primary-800 transform rotate-1 hover:rotate-0 hover:scale-105 transition duration-500 ease-in-out">
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Stats Section -->
<section class="bg-white py-12 shadow-sm relative z-20 -mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-6 bg-gradient-to-br from-primary-50 to-white rounded-xl border border-primary-100 shadow-sm hover:shadow-md transition">
                <div class="text-4xl font-bold text-primary-600 mb-2 font-serif">250+</div>
                <div class="text-gray-600 font-medium">Trusted Suppliers</div>
            </div>
            <div class="p-6 bg-gradient-to-br from-primary-50 to-white rounded-xl border border-primary-100 shadow-sm hover:shadow-md transition">
                <div class="text-4xl font-bold text-primary-600 mb-2 font-serif">15K+</div>
                <div class="text-gray-600 font-medium">Tons Processed</div>
            </div>
            <div class="p-6 bg-gradient-to-br from-primary-50 to-white rounded-xl border border-primary-100 shadow-sm hover:shadow-md transition">
                <div class="text-4xl font-bold text-primary-600 mb-2 font-serif">120+</div>
                <div class="text-gray-600 font-medium">Industrial Clients</div>
            </div>
            <div class="p-6 bg-gradient-to-br from-primary-50 to-white rounded-xl border border-primary-100 shadow-sm hover:shadow-md transition">
                <div class="text-4xl font-bold text-primary-600 mb-2 font-serif">98%</div>
                <div class="text-gray-600 font-medium">On-Time Delivery</div>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-20 bg-gradient-to-b from-primary-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block bg-gold text-black px-4 py-1 rounded-full text-sm font-semibold mb-3 shadow-sm">
                OUR STORY
            </span>
            <h2 class="text-4xl font-bold text-primary-800 mb-4">About GoldenFields</h2>
            <div class="w-20 h-1.5 bg-secondary-500 mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Established in 2012, GoldenFields Industries has grown to become a leading player in the sugar supply chain, bridging the gap between producers and markets with integrity and efficiency.
            </p>
        </div>
        
        <div class="flex flex-col lg:flex-row items-stretch gap-12">
            <!-- Image Column -->
            <div class="lg:w-1/2 relative">
                <div class="relative h-full rounded-xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('sugar-processing-plant.jpg') }}" alt="Sugar processing plant" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-900/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent">
                        <p class="text-white text-lg font-medium">Our state-of-the-art processing facility in Kenya</p>
                    </div>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="lg:w-1/2 space-y-8">
                <!-- Mission Card -->
                <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-gold transform hover:-translate-y-1 transition duration-300">
                    <div class="flex items-start mb-4">
                        <div class="bg-primary-100 p-3 rounded-full mr-4 text-primary-700">
                            <i class="fas fa-bullseye text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-800 mb-2">Our Mission</h3>
                            <p class="text-gray-700 leading-relaxed">
                                To revolutionize the sugar supply chain by implementing innovative technologies that enhance transparency, reduce waste, and maximize value for all stakeholders - from smallholder farmers to multinational corporations.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Vision Card -->
                <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-gold transform hover:-translate-y-1 transition duration-300">
                    <div class="flex items-start mb-4">
                        <div class="bg-yellow-50 p-3 rounded-full mr-4 text-yellow-600">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-800 mb-2">Our Vision</h3>
                            <p class="text-gray-700 leading-relaxed">
                                To be the most trusted and efficient sugar supply chain network in the region, recognized for our commitment to quality, sustainability, and fair trade practices.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Values Card -->
                <div class="bg-primary-800 text-white p-8 rounded-xl shadow-lg">
                    <h4 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-star mr-3 text-gold"></i>
                        <span>Our Core Values</span>
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start">
                            <div class="bg-primary-700 p-2 rounded-full mr-3 mt-1">
                                <i class="fas fa-check text-gold text-sm"></i>
                            </div>
                            <span class="text-primary-100">Integrity in all transactions</span>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary-700 p-2 rounded-full mr-3 mt-1">
                                <i class="fas fa-check text-gold text-sm"></i>
                            </div>
                            <span class="text-primary-100">Sustainable agricultural practices</span>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary-700 p-2 rounded-full mr-3 mt-1">
                                <i class="fas fa-check text-gold text-sm"></i>
                            </div>
                            <span class="text-primary-100">Technological innovation</span>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary-700 p-2 rounded-full mr-3 mt-1">
                                <i class="fas fa-check text-gold text-sm"></i>
                            </div>
                            <span class="text-primary-100">Fair compensation for producers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Our Services</h2>
                <div class="w-20 h-1 bg-gold mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Comprehensive solutions tailored to meet the needs of every participant in the sugar value chain.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-primary-50 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                    <div class="h-48 bg-primary-600 flex items-center justify-center">
                        <i class="fas fa-truck text-gold text-5xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-800 mb-3">Logistics & Distribution</h3>
                        <p class="text-gray-700 mb-4">
                            Efficient transportation and warehousing solutions ensuring your sugar products reach their destination in optimal condition and on time.
                        </p>
                        <a href="#" class="text-black-600 font-medium hover:text-primary-800 flex items-center">
                            Learn more <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="bg-primary-50 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                    <div class="h-48 bg-primary-600 flex items-center justify-center">
                        <i class="fas fa-flask text-gold text-5xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-800 mb-3">Quality Assurance</h3>
                        <p class="text-gray-700 mb-4">
                            Rigorous testing and certification processes to guarantee product quality meets international standards and specifications.
                        </p>
                        <a href="#" class="text-black-600 font-medium hover:text-primary-800 flex items-center">
                            Learn more <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="bg-primary-50 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                    <div class="h-48 bg-primary-600 flex items-center justify-center">
                        <i class="fas fa-chart-line text-gold text-5xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-800 mb-3">Market Intelligence</h3>
                        <p class="text-gray-700 mb-4">
                            Data-driven insights and analytics to help suppliers and buyers make informed decisions in volatile sugar markets.
                        </p>
                        <a href="#" class="text-black-800 font-medium hover:text-primary-800 flex items-center">
                            Learn more <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-20 bg-primary-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-4">Our Product Portfolio</h2>
                <div class="w-20 h-1 bg-gold mx-auto mb-6"></div>
                <p class="text-lg text-primary-200 max-w-3xl mx-auto">
                    High-quality sugar products tailored for various industrial and consumer applications.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="bg-white text-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('raw-sugar.jpg') }}" alt="Raw Sugar" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-800 mb-2">Raw Sugar</h3>
                        <p class="text-gray-600 mb-4">
                            Unrefined sugar with natural molasses content, ideal for industrial refining processes.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary-700">ICUMSA 600-1200</span>
                            <a href="#" class="text-gold hover:text-secondary-700">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="bg-white text-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('white-sugar.jpg') }}" alt="White Sugar" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-800 mb-2">White Refined Sugar</h3>
                        <p class="text-gray-600 mb-4">
                            High-purity sucrose crystals for food processing, beverage, and consumer markets.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary-700">ICUMSA 45</span>
                            <a href="#" class="text-gold hover:text-secondary-700">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="bg-white text-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('brown-sugar.jpg') }}" alt="Brown Sugar" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-800 mb-2">Brown Sugar</h3>
                        <p class="text-gray-600 mb-4">
                            Partially refined sugar with natural molasses flavor, perfect for specialty foods.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary-700">D3EK-20</span>
                            <a href="#" class="text-gold hover:text-secondary-700">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="bg-white text-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('molasses.jpg') }}" alt="molasses" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary-800 mb-2">Molasses</h3>
                        <p class="text-gray-600 mb-4">
                          Premium-grade molasses derived from carefully processed sugarcane to meet industrial and agricultural demands.

                        </p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary-700">67-70 Brix</span>
                            <a href="#" class="text-gold hover:text-secondary-700">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block bg-secondary-500 hover:bg-secondary-600 text-white px-8 py-3 rounded-md font-semibold text-lg transition transform hover:scale-105">
                    View Full Product Catalog <i class="fas fa-book-open ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">What Our Partners Say</h2>
                <div class="w-20 h-1 bg-gold mx-auto mb-6"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">
                        "GoldenFields Agro has transformed our sugar export business. Their logistics network ensures our products reach international buyers in perfect condition every time."
                    </p>
                    <div class="flex items-center">
                        <img src="{{ asset('testimonial1.jpg') }}" alt="Raj Patel" class="h-12 w-12 rounded-full mr-4 object-cover">
                        <div>
                            <h4 class="font-semibold text-primary-800">Raj Patel</h4>
                            <p class="text-sm text-gray-600">Director, SweetCane Exports</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">
                        "As a beverage manufacturer, we rely on consistent sugar quality. GoldenFields' rigorous QA process gives us complete confidence in every shipment."
                    </p>
                    <div class="flex items-center">
                        <img src="{{ asset('testimonial2.jpg') }}" alt="Maria Gonzalez" class="h-12 w-12 rounded-full mr-4 object-cover">
                        <div>
                            <h4 class="font-semibold text-primary-800">Maria Gonzalez</h4>
                            <p class="text-sm text-gray-600">Procurement Manager, RefreshCo</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">
                        "Their digital platform provides real-time tracking and documentation that has streamlined our import process significantly. A truly modern supply chain partner."
                    </p>
                    <div class="flex items-center">
                        <img src="{{ asset('testimonial3.jpg') }}" alt="James Wilson" class="h-12 w-12 rounded-full mr-4 object-cover">
                        <div>
                            <h4 class="font-semibold text-primary-800">James Wilson</h4>
                            <p class="text-sm text-gray-600">Operations Director, EuroSweet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Transform Your Sugar Supply Chain?</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                Join hundreds of satisfied suppliers and buyers who trust GoldenFields for their sugar supply chain needs.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-white text-primary-800 hover:bg-primary-50 px-8 py-4 rounded-md font-semibold text-lg border border-primary-300 transition transform hover:scale-105">
                    Register as Supplier <i class="fas fa-tractor ml-2"></i>
                </a>
                <a href="{{ route('register') }}" class="bg-gold hover:bg-secondary-600 text-white px-8 py-4 rounded-md font-semibold text-lg shadow-lg transition transform hover:scale-105">
                    Register as Buyer <i class="fas fa-industry ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Contact Us</h2>
                <div class="w-20 h-1 bg-gold mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Have questions about our services or products? Our team is ready to assist you.
                </p>
            </div>
            
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-1/2">
                    <div class="bg-primary-50 rounded-lg p-8 h-full">
                        <h3 class="text-2xl font-semibold text-primary-800 mb-6">Get In Touch</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-primary-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-map-marker-alt text-primary-700"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-primary-800 mb-1">Headquarters</h4>
                                    <p class="text-gray-700">123 Agro Business Park, Sugar Valley, SV 12345</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-phone-alt text-primary-700"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-primary-800 mb-1">Phone</h4>
                                    <p class="text-gray-700">+1 (800) 123-4567</p>
                                    <p class="text-gray-700">+1 (800) 765-4321 (24/7 Support)</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-envelope text-primary-700"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-primary-800 mb-1">Email</h4>
                                    <p class="text-gray-700">info@goldenfieldsagro.com</p>
                                    <p class="text-gray-700">sales@goldenfieldsagro.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-clock text-primary-700"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-primary-800 mb-1">Business Hours</h4>
                                    <p class="text-gray-700">Monday - Friday: 8:00 AM - 6:00 PM</p>
                                    <p class="text-gray-700">Saturday: 9:00 AM - 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h4 class="font-semibold text-primary-800 mb-4">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="bg-primary-100 hover:bg-primary-200 text-primary-700 p-3 rounded-full transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="bg-primary-100 hover:bg-primary-200 text-primary-700 p-3 rounded-full transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="bg-primary-100 hover:bg-primary-200 text-primary-700 p-3 rounded-full transition">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="bg-primary-100 hover:bg-primary-200 text-primary-700 p-3 rounded-full transition">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2">
                    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200">
                        <h3 class="text-2xl font-semibold text-primary-800 mb-6">Send Us a Message</h3>
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                                    <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                    <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                                <input type="text" id="subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </div>
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                                <textarea id="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"></textarea>
                            </div>
                            <button type="submit" class="bg-gold hover:bg-secondary-600 text-white px-6 py-3 rounded-md font-semibold transition w-full">
                                Send Message <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('sucham.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full">
                        <h3 class="text-xl font-bold">GoldenFields Agro</h3>
                    </div>
                    <p class="text-primary-200 mb-4 ">
                        Connecting sugar producers with global markets through innovative supply chain solutions.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-primary-200 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-primary-200 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-primary-200 hover:text-white transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-primary-200 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-primary-200 hover:text-white transition">Dashboard</a></li>
                        <li><a href="#about" class="text-primary-200 hover:text-white transition">About Us</a></li>
                        <li><a href="#services" class="text-primary-200 hover:text-white transition">Services</a></li>
                        <li><a href="#products" class="text-primary-200 hover:text-white transition">Products</a></li>
                        <li><a href="#contact" class="text-primary-200 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Services</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-primary-200 hover:text-white transition">Supply Chain Management</a></li>
                        <li><a href="#" class="text-primary-200 hover:text-white transition">Quality Assurance</a></li>
                        <li><a href="#" class="text-primary-200 hover:text-white transition">Logistics Solutions</a></li>
                        <li><a href="#" class="text-primary-200 hover:text-white transition">Market Analysis</a></li>
                        <li><a href="#" class="text-primary-200 hover:text-white transition">Farmer Support</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-primary-200 mb-4">
                        Subscribe to our newsletter for the latest updates on sugar markets and industry trends.
                    </p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-md w-full focus:outline-none text-gray-800">
                        <button type="submit" class="bg-secondary-500 hover:bg-secondary-600 px-4 py-2 rounded-r-md">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-primary-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-primary-300 mb-4 md:mb-0">
                    &copy; {{ date('Y') }} GoldenFields Agro Industries Ltd. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-primary-300 hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="text-primary-300 hover:text-white transition">Terms of Service</a>
                    <a href="#" class="text-primary-300 hover:text-white transition">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>