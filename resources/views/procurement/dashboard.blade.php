<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Procurement Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/procurement.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="golden-theme">

    <!-- Header -->
    <header class="dashboard-header">
        <div class="header-container">
            <div class="logo-container">
                <img src="{{ asset('images/goldenfields-logo.png') }}" alt="GoldenFields Logo" class="logo">
                <h1>Procurement Dashboard</h1>
            </div>
            <div class="header-right">
                <div class="datetime">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="current-date">{{ now()->format('F j, Y') }}</span>
                </div>
                <div class="user-profile">
                    <div class="avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="user-info">
                        <span class="username">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="role">Procurement Manager</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Dashboard Wrapper -->
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <nav class="sidebar-nav">
                <ul>
                    <li class="active">
                        <a href="#">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Purchase Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-truck"></i>
                            <span>Suppliers</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-boxes"></i>
                            <span>Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Invoices</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chart-line"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-content">
            <!-- Overview Cards -->
            <section class="dashboard-overview">
                <div class="dashboard-tabs">
                    <a href="#">All Requests</a>
                    <a href="#">My Requests</a>
                </div>

                <div class="overview-cards">
                    <div class="stat-card">
                        <h2>{{ $requests }}</h2>
                        <p>Procurement Requests</p>
                    </div>
                    <div class="stat-card">
                        <h2>{{ $orders }}</h2>
                        <p>Purchase Orders</p>
                    </div>
                    <div class="stat-card">
                        <h2>{{ $received }}</h2>
                        <p>Goods Received</p>
                    </div>
                    <div class="stat-card">
                        <h2>{{ $suppliers }}</h2>
                        <p>Suppliers</p>
                    </div>
                </div>
            </section>

            <!-- Charts -->
            <section class="dashboard-charts">
                <div class="chart-row">
                    <div class="chart-card">
                        <h3><i class="fas fa-chart-bar"></i> Monthly Procurement</h3>
                        <canvas id="monthlyChart"></canvas>
                    </div>
                    <div class="chart-card">
                        <h3><i class="fas fa-chart-pie"></i> Supplier Distribution</h3>
                        <div id="supplierChart"></div>
                    </div>
                </div>
            </section>

            <!-- Recent Activity -->
            <section class="recent-activity">
                <div class="section-header">
                    <h3><i class="fas fa-clock"></i> Recent Activity</h3>
                    <a href="#" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                @include('procurement.partials.activity')
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} GoldenFields Procurement System. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Help Center</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/procurement.js') }}"></script>
    <script>
        // Supplier donut chart
        var supplierChart = new ApexCharts(document.querySelector("#supplierChart"), {
            series: [30, 40, 30],
            chart: {
                type: 'donut',
                height: 350,
                foreColor: '#333'
            },
            labels: ['Local', 'National', 'International'],
            colors: ['#D4AF37', '#2E8B57', '#006400'],
            legend: {
                position: 'bottom',
                fontSize: '14px',
                fontFamily: 'Poppins, sans-serif'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: '100%'
                    }
                }
            }]
        });
        supplierChart.render();

        // Monthly procurement bar chart
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Procurement Value ($)',
                    data: [12500, 19000, 3000, 5000, 2000, 3000, 8000],
                    backgroundColor: '#D4AF37',
                    borderColor: '#996515',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Poppins',
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },
                        ticks: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
