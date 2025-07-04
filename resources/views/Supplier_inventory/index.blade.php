<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Inventory Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        // Initialize jsPDF
        const { jsPDF } = window.jspdf;
        
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            100: '#fff9e6',
                            300: '#ffdf80',
                            500: '#ffd700',
                            700: '#e6c200',
                        },
                        green: {
                            100: '#e6f7e6',
                            300: '#80c080',
                            500: '#228b22',
                            700: '#1a6e1a',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        .glow-card {
            box-shadow: 0 4px 20px -2px rgba(218, 165, 32, 0.3);
            transition: all 0.3s ease;
        }
        .glow-card:hover {
            box-shadow: 0 4px 25px -1px rgba(218, 165, 32, 0.5);
            transform: translateY(-2px);
        }
        .btn-gold {
            background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            background: linear-gradient(135deg, #e6c200 0%, #ffd700 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(230, 194, 0, 0.3);
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        .chart-container {
            position: relative;
            height: 100%;
            width: 100%;
        }
        [data-tooltip] {
            position: relative;
            cursor: pointer;
        }
        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 100;
            margin-bottom: 5px;
        }
        .pdf-export-area {
            position: relative;
        }
        .pdf-export-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            z-index: 1000;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #228b22;
            font-weight: bold;
        }
        .pdf-export-area.exporting::before {
            content: 'Generating PDF...';
            display: flex;
        }
    </style>
</head>
<body class="bg-green-50 text-gray-800">

    <div class="container mx-auto px-4 py-8 pdf-export-area" id="pdfExportArea">
        <!-- Header Section -->
        <div class="flex flex-col items-center text-center mb-10">
            <h1 class="text-4xl font-bold text-green-700 mb-4 flex items-center">
                <i class="fas fa-boxes text-gold-500 mr-3 animate-float"></i>
                 Inventory Management
            </h1>
            <p class="text-gold-700 max-w-2xl mb-6">Manage and track your inventory with real-time analytics and interactive reports</p>
            
            <!-- Centered Add Inventory Button -->
            <div class="flex justify-right w-full mb-8">
                <a href="{{ route('supplier_inventory.create') }}" 
                   class="btn-gold text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg flex items-right transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i> Add New Inventory Item
                </a>
                
                <!-- PDF Export Button -->
                <button onclick="exportToPDF()" 
                        class="ml-4 bg-green-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-green-700 hover:shadow-lg flex items-center transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white glow-card p-6 rounded-xl border-l-4 border-gold-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Total Products</p>
                        <h3 class="text-3xl font-bold text-green-700">{{ $inventories->count() }}</h3>
                    </div>
                    <div class="bg-gold-100 p-3 rounded-full">
                        <i class="fas fa-box-open text-gold-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white glow-card p-6 rounded-xl border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Total Supplies</p>
                        <h3 class="text-3xl font-bold text-green-700">{{ $inventories->groupBy('supplier_id')->count() }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-truck text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white glow-card p-6 rounded-xl border-l-4 border-gold-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Total inventory</p>
                        <h3 class="text-3xl font-bold text-green-700">{{ $inventories->sum('quantity') }}</h3>
                    </div>
                    <div class="bg-gold-100 p-3 rounded-full">
                        <i class="fas fa-cubes text-gold-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <!-- Inventory Distribution Chart -->
            <div class="bg-white glow-card p-6 rounded-xl">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-green-700 flex items-center">
                        <i class="fas fa-chart-pie text-gold-500 mr-2"></i>
                        Inventory Distribution
                    </h2>
                    <div class="flex space-x-2">
                        <button onclick="toggleChartType('inventoryChart')" 
                                class="px-3 py-1 text-xs bg-green-50 text-green-600 rounded hover:bg-green-100"
                                data-tooltip="Switch Chart Type">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="inventoryChart"></canvas>
                </div>
            </div>
            
            <!-- Quantity Trend Chart -->
            <div class="bg-white glow-card p-6 rounded-xl">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-green-700 flex items-center">
                        <i class="fas fa-chart-line text-gold-500 mr-2"></i>
                        Inventory Trend
                    </h2>
                    <div class="flex space-x-2">
                        <select onchange="updateTrendChart(this.value)" 
                                class="text-xs border border-green-200 rounded px-2 py-1 bg-white">
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white glow-card rounded-xl overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-green-100 flex flex-col sm:flex-row justify-between items-center bg-green-600">
                <h2 class="text-xl font-semibold text-white mb-2 sm:mb-0">Inventory Items</h2>
                <div class="relative w-full sm:w-64">
                    <input type="text" placeholder="Search product..." 
                           class="w-full pl-10 pr-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-gold-500">
                    <i class="fas fa-search absolute left-3 top-2.5 text-green-400"></i>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-green-200">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">PRODUCT</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">SKU</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">STOCK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">SUPPLY</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">UNIT PRICE</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">UNIT</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">STATUS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">ACTION</th>
                            
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-green-200">
                        @foreach ($inventories as $item)
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gold-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-store text-gold-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-green-800">{{ $item->PRODUCT->PRODUCT_NAME ?? 'N/A' }}</div>
                                        <div class="text-sm text-green-500">{{ $item->supplier->contact_person ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-green-800">{{ $item->product_name }}</div>
                                <div class="text-sm text-gray-500">SKU: {{ $item->sku ?? '--' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $item->STOCK > 20 ? 'bg-green-100 text-green-800' : 'bg-gold-100 text-gold-800' }}">
                                        {{ $item->STOCK }}
                                    </span>
                                    @if($item->STOCK < 10)
                                    <span class="ml-2 text-red-500 text-xs animate-pulse-slow">
                                        <i class="fas fa-exclamation-circle"></i> Low Stock
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->unit }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-gold-600 hover:text-gold-900 mr-3" data-tooltip="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900" data-tooltip="Analytics">
                                    <i class="fas fa-chart-line"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700 ml-3" data-tooltip="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-green-100 bg-green-50 flex flex-col sm:flex-row items-center justify-between">
                <div class="text-sm text-gray-600 mb-2 sm:mb-0">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ $inventories->count() }}</span> results
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-md bg-white border border-green-200 text-green-600 hover:bg-green-50">
                        Previous
                    </button>
                    <button class="px-3 py-1 rounded-md bg-green-600 text-white hover:bg-green-700">
                        1
                    </button>
                    <button class="px-3 py-1 rounded-md bg-white border border-green-200 text-green-600 hover:bg-green-50">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for demonstration
        const inventoryData = {
            labels: @json($inventories->pluck('PRODUCT_NAME')),
            quantities: @json($inventories->pluck('STOCK')),
            suppliers: @json($inventories->map(fn($item) => $item->PRODUCT->PRODUCT_NAME ?? 'Unknown')),
            colors: [
                'rgba(255, 215, 0, 0.8)',
                'rgba(34, 139, 34, 0.8)',
                'rgba(218, 165, 32, 0.8)',
                'rgba(50, 205, 50, 0.8)',
                'rgba(240, 230, 140, 0.8)',
                'rgba(34, 139, 34, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(50, 205, 50, 0.6)'
            ]
        };

        // Inventory Chart (Doughnut/Pie)
        const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
        let inventoryChart = new Chart(inventoryCtx, {
            type: 'doughnut',
            data: {
                labels: inventoryData.labels,
                datasets: [{
                    data: inventoryData.quantities,
                    backgroundColor: inventoryData.colors,
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            font: {
                                family: "'Inter', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        },
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: true,
                        borderColor: 'rgba(255, 215, 0, 0.3)',
                        borderWidth: 1
                    },
                    datalabels: {
                        display: false
                    }
                },
                cutout: '65%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                onClick: (e, elements) => {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        alert(`Selected: ${inventoryData.labels[index]}\nQuantity: ${inventoryData.quantities[index]}\nSupplier: ${inventoryData.suppliers[index]}`);
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Trend Chart (Line/Bar)
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        let trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Inventory Quantity',
                    data: [120, 190, 170, 210, 180, 220, 240],
                    backgroundColor: 'rgba(34, 139, 34, 0.2)',
                    borderColor: 'rgba(34, 139, 34, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgba(255, 215, 0, 1)',
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'xy',
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });

        // Toggle between doughnut and pie chart
        function toggleChartType(chartId) {
            if (chartId === 'inventoryChart') {
                inventoryChart.destroy();
                inventoryChart = new Chart(inventoryCtx, {
                    type: inventoryChart.config.type === 'doughnut' ? 'pie' : 'doughnut',
                    data: inventoryChart.data,
                    options: inventoryChart.options
                });
            }
        }

        // Update trend chart based on time period
        function updateTrendChart(period) {
            let labels, data;
            
            switch(period) {
                case 'monthly':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
                    data = [120, 190, 170, 210, 180, 220, 240];
                    break;
                case 'quarterly':
                    labels = ['Q1', 'Q2', 'Q3', 'Q4'];
                    data = [480, 610, 530, 720];
                    break;
                case 'yearly':
                    labels = ['2020', '2021', '2022', '2023'];
                    data = [2340, 2840, 3120, 2950];
                    break;
            }
            
            trendChart.data.labels = labels;
            trendChart.data.datasets[0].data = data;
            trendChart.update();
        }

        // Add hover effects to table rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.boxShadow = '0 4px 15px -3px rgba(218, 165, 32, 0.2)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
            
            // Add click effect
            row.addEventListener('click', function() {
                this.classList.toggle('bg-gold-50');
            });
        });

        // Export to PDF function
        async function exportToPDF() {
            const pdfExportArea = document.getElementById('pdfExportArea');
            pdfExportArea.classList.add('exporting');
            
            // Create a new jsPDF instance
            const pdf = new jsPDF('p', 'pt', 'a4');
            
            // Use html2canvas to capture the content
            const canvas = await html2canvas(pdfExportArea, {
                scale: 2,
                logging: false,
                useCORS: true,
                allowTaint: true,
                scrollY: -window.scrollY
            });
            
            // Add the canvas image to the PDF
            const imgData = canvas.toDataURL('image/png');
            const imgWidth = pdf.internal.pageSize.getWidth() - 40;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            pdf.addImage(imgData, 'PNG', 20, 40, imgWidth, imgHeight);
            
            // Add title and date to the PDF
            pdf.setFontSize(18);
            pdf.setTextColor(34, 139, 34);
            pdf.text('Supplier Inventory Report', pdf.internal.pageSize.getWidth() / 2, 30, { align: 'center' });
            
            const currentDate = new Date().toLocaleDateString();
            pdf.setFontSize(10);
            pdf.setTextColor(100, 100, 100);
            pdf.text(`Generated on: ${currentDate}`, pdf.internal.pageSize.getWidth() - 20, 30, { align: 'right' });
            
            // Save the PDF
            pdf.save('Supplier_Inventory_Report.pdf');
            
            pdfExportArea.classList.remove('exporting');
        }
    </script>

</body>
</html>