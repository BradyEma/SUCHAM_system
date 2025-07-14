<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Orders </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --gold-primary: #D4AF37;
            --gold-light: #FFD700;
            --gold-dark: #996515;
            --green-primary: #2E8B57;
            --green-light: #3CB371;
            --green-dark: #1E5631;
            --gradient-green-gold: linear-gradient(135deg, var(--green-dark) 0%, var(--green-primary) 50%, var(--gold-primary) 100%);
            --gradient-gold-green: linear-gradient(135deg, var(--gold-primary) 0%, var(--green-primary) 100%);
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .gold-bg { background-color: var(--gold-primary); }
        .green-bg { background-color: var(--green-primary); }
        .gold-text { color: var(--gold-primary); }
        .green-text { color: var(--green-primary); }
        
        .gradient-header {
            background: var(--gradient-green-gold);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .table-header {
            background: var(--gradient-gold-green);
            color: white;
        }
        
        .alternate-row {
            background-color: rgba(233, 245, 233, 0.5);
        }
        
        .gold-border {
            border-color: var(--gold-primary) !important;
        }
        
        .green-border {
            border-color: var(--green-primary) !important;
        }
        
        .card-shadow {
            box-shadow: 0 6px 15px rgba(46, 139, 87, 0.1);
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(46, 139, 87, 0.15);
        }
        
        .btn-gold {
            background-color: var(--gold-primary);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-gold:hover {
            background-color: var(--gold-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
        }
        
        .btn-green {
            background-color: var(--green-primary);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-green:hover {
            background-color: var(--green-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(46, 139, 87, 0.3);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-approved {
            background-color: rgba(46, 139, 87, 0.1);
            color: var(--green-primary);
            border: 1px solid var(--green-primary);
        }
        
        .badge-pending {
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--gold-dark);
            border: 1px solid var(--gold-dark);
        }
        
        .badge-rejected {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid #dc3545;
        }
        
        .search-box {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .search-box:focus-within {
            transform: scale(1.02);
        }
        
        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold-primary);
        }
        
        .search-input {
            padding-left: 40px;
            border-radius: 20px;
            border: 1px solid var(--gold-primary);
        }
        
        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        
        .action-btn:hover {
            transform: scale(1.1);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--green-primary);
            border-color: var(--green-primary);
        }
        
        .pagination .page-link {
            color: var(--green-primary);
        }
        
        .floating-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 6px 15px rgba(212, 175, 55, 0.3);
            z-index: 100;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(212, 175, 55, 0); }
            100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
        }
        
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        .table-hover tbody tr {
            transition: all 0.2s ease;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(212, 175, 55, 0.1) !important;
            transform: translateX(5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid px-4">
        <!-- Header Bar -->
        <div class="row mb-4 gradient-header py-3 rounded-3 animate__animated animate__fadeInDown">
            <div class="col d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-invoice-dollar text-white fs-1 me-3"></i>
                    <div>
                        <h2 class="text-white mb-0 fw-bold">Purchase Orders</h2>
                        <small class="text-white-50">GoldenField Procurement System</small>
                    </div>
                </div>
                <div class="ms-auto d-flex align-items-center">
                    <div class="search-box me-3">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control search-input" placeholder="Search POs...">
                    </div>
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-light dropdown-toggle gold-border" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle text-success me-2"></i>Approved</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-clock text-warning me-2"></i>Pending</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-times-circle text-danger me-2"></i>Rejected</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-filter me-2"></i>Custom Filter</a></li>
                        </ul>
                    </div>
                    <a href="{{ route('purchase-orders.create') }}" class="btn btn-gold">
                        <i class="fas fa-plus me-1"></i> New PO
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4 animate__animated animate__fadeIn">
            <div class="col-md-3">
                <div class="card card-shadow hover-scale">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-check-circle fs-3 text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Approved POs</h6>
                                <h4 class="mb-0 fw-bold text-success">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-shadow hover-scale">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-clock fs-3 text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Pending POs</h6>
                                <h4 class="mb-0 fw-bold text-warning">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-shadow hover-scale">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-times-circle fs-3 text-danger"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Rejected POs</h6>
                                <h4 class="mb-0 fw-bold text-danger">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-shadow hover-scale">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-dollar-sign fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Total Value</h6>
                                <h4 class="mb-0 fw-bold text-primary">UG shs0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchase Orders Table -->
        <div class="card card-shadow animate__animated animate__fadeInUp">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-header">
                            <tr>
                                <th class="ps-4"><i class="fas fa-hashtag me-2"></i>PO Number</th>
                                <th><i class="fas fa-building me-2"></i>Customer</th>
                                <th><i class="fas fa-calendar-alt me-2"></i>Order Date</th>
                                <th><i class="fas fa-money-bill-wave me-2"></i>Total Amount</th>
                                <th><i class="fas fa-info-circle me-2"></i>Status</th>
                                <th class="text-end pe-4"><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchaseOrders as $po)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'alternate-row' : '' }}">
                                <td class="ps-4 {{ $po->status == 'pending' ? 'gold-text fw-bold' : 'fw-semibold' }}">
                                    <i class="fas fa-file-invoice me-2"></i>{{ $po->po_number }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 p-2 rounded me-2">
                                            <i class="fas fa-store text-success"></i>
                                        </div>
                                        <span class="green-text fw-medium">{{ $po->vendor->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                                            <i class="fas fa-calendar-day text-primary"></i>
                                        </div>
                                        <span>{{ $po->order_date->format('d M Y') }}</span>
                                    </div>
                                </td>
                                <td class="fw-bold gold-text">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 p-2 rounded me-2">
                                            <i class="fas fa-dollar-sign text-warning"></i>
                                        </div>
                                        <span>{{ number_format($po->total_amount, 2) }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($po->status == 'approved')
                                        <span class="status-badge badge-approved">
                                            <i class="fas fa-check-circle me-1"></i> Approved
                                        </span>
                                    @elseif($po->status == 'pending')
                                        <span class="status-badge badge-pending">
                                            <i class="fas fa-clock me-1"></i> Pending
                                        </span>
                                    @else
                                        <span class="status-badge badge-rejected">
                                            <i class="fas fa-times-circle me-1"></i> Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('purchase-orders.edit', $po->id) }}" class="action-btn btn-gold me-2" title="Edit">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                        <a href="{{ route('purchase-orders.show', $po->id) }}" class="action-btn btn-green" title="View">
                                            <i class="fas fa-eye text-white"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4 animate__animated animate__fadeIn">
            <div class="text-muted">
                Showing {{ $purchaseOrders->firstItem() }} to {{ $purchaseOrders->lastItem() }} of {{ $purchaseOrders->total() }} entries
            </div>
            <div>
                {{ $purchaseOrders->links() }}
            </div>
        </div>
        
        <!-- Floating Action Button -->
        <a href="{{ route('purchase-orders.create') }}" class="floating-btn btn-gold animate__animated animate__bounceInUp">
            <i class="fas fa-plus text-white"></i>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add animation to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('animate__animated', 'animate__fadeInUp');
            });
            
            // Tooltip initialization
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>