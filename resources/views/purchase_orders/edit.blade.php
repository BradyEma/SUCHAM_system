<!-- Edit Blade (edit.blade.php) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Purchase Order - GoldenFields</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gold-bg { background-color: #D4AF37; }
        .green-bg { background-color: #2E8B57; }
        .gold-text { color: #D4AF37; }
        .green-text { color: #2E8B57; }
        .gradient-header {
            background: linear-gradient(to right, #2E8B57, #D4AF37);
        }
        .table-header {
            background-color: #2E8B57;
            color: #D4AF37;
        }
        .gold-border {
            border-color: #D4AF37 !important;
        }
        .green-border {
            border-color: #2E8B57 !important;
        }
        .gold-card {
            border: 1px solid #D4AF37;
        }
        .pending-alert {
            background-color: #D4AF37;
            color: white;
        }
        .approved-alert {
            background-color: #2E8B57;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h2 class="gold-text">Edit Purchase Order #{{ $purchaseOrder->po_number }}</h2>
                <a href="{{ route('purchase-orders.index') }}" class="btn btn-sm gold-border gold-text">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <!-- Status Banner -->
        @if($purchaseOrder->status == 'pending')
            <div class="alert pending-alert mb-3">
                <i class="fas fa-exclamation-circle"></i> Pending Approval
            </div>
        @elseif($purchaseOrder->status == 'approved')
            <div class="alert approved-alert mb-3">
                <i class="fas fa-lock"></i> Approved (Read-Only)
            </div>
        @endif

        <!-- Form -->
        <div class="card shadow-sm gold-card">
            <div class="card-body">
                <form action="{{ route('purchase-orders.update', $purchaseOrder->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Vendor Selection -->
                    <div class="form-group mb-4">
                        <label class="green-text fw-bold">Vendor</label>
                        <select class="form-control gold-border" name="vendor_id" {{ $purchaseOrder->status == 'approved' ? 'disabled' : '' }}>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ $purchaseOrder->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Order Details -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="green-text fw-bold">Order Date</label>
                            <input type="date" class="form-control gold-border" name="order_date" 
                                   value="{{ $purchaseOrder->order_date->format('Y-m-d') }}" 
                                   {{ $purchaseOrder->status == 'approved' ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label class="green-text fw-bold">Delivery Date</label>
                            <input type="date" class="form-control gold-border" name="delivery_date" 
                                   value="{{ $purchaseOrder->delivery_date->format('Y-m-d') }}" 
                                   {{ $purchaseOrder->status == 'approved' ? 'readonly' : '' }}>
                        </div>
                    </div>

                    <!-- Line Items -->
                    <div class="mb-4">
                        <label class="green-text fw-bold">Items</label>
                        <table class="table" id="items-table">
                            <thead class="table-header">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseOrder->items as $index => $item)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="items[{{ $index }}][name]" 
                                               value="{{ $item->name }}" {{ $purchaseOrder->status == 'approved' ? 'readonly' : '' }}>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="items[{{ $index }}][quantity]" 
                                               value="{{ $item->quantity }}" {{ $purchaseOrder->status == 'approved' ? 'readonly' : '' }}>
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" class="form-control" name="items[{{ $index }}][unit_price]" 
                                               value="{{ $item->unit_price }}" {{ $purchaseOrder->status == 'approved' ? 'readonly' : '' }}>
                                    </td>
                                    <td>
                                        <span class="item-total">{{ number_format($item->quantity * $item->unit_price, 2) }}</span>
                                    </td>
                                    <td>
                                        @if($purchaseOrder->status != 'approved')
                                            <button type="button" class="btn btn-sm btn-danger remove-item">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($purchaseOrder->status != 'approved')
                            <button type="button" class="btn btn-sm gold-bg text-white" id="add-item">
                                <i class="fas fa-plus"></i> Add Item
                            </button>
                        @endif
                    </div>

                    <!-- Notes -->
                    <div class="form-group mb-4">
                        <label class="green-text fw-bold">Notes</label>
                        <textarea class="form-control gold-border" name="notes" rows="3" 
                                  {{ $purchaseOrder->status == 'approved' ? 'readonly' : '' }}>{{ $purchaseOrder->notes }}</textarea>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-end">
                        @if($purchaseOrder->status != 'approved')
                            <button type="submit" class="btn me-2 gold-bg text-white">
                                <i class="fas fa-save"></i> Update PO
                            </button>
                            <a href="#" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('add-item').addEventListener('click', function() {
            const table = document.getElementById('items-table').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length;
            const newRow = table.insertRow(rowCount);
            
            newRow.innerHTML = `
                <td><input type="text" class="form-control" name="items[${rowCount}][name]"></td>
                <td><input type="number" class="form-control" name="items[${rowCount}][quantity]"></td>
                <td><input type="number" step="0.01" class="form-control" name="items[${rowCount}][unit_price]"></td>
                <td><span class="item-total">0.00</span></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-item"><i class="fas fa-trash"></i></button></td>
            `;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
</body>
</html>