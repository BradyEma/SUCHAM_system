<!-- Create Blade (create.blade.php) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Purchase Order - GoldenFields</title>
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h2 class="gold-text">Create New Purchase Order</h2>
                <a href="{{ route('purchase-orders.index') }}" class="btn btn-sm gold-border gold-text">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="card shadow-sm gold-card">
            <div class="card-body">
                <form action="{{ route('purchase-orders.store') }}" method="POST">
                    @csrf

                    <!-- Vendor Selection -->
                    <div class="form-group mb-4">
                        <label class="green-text fw-bold">Vendor</label>
                        <select class="form-control gold-border" name="vendor_id">
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Can't find a vendor? <a href="#" class="green-text">Add New</a></small>
                    </div>

                    <!-- Order Details -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="green-text fw-bold">Order Date</label>
                            <input type="date" class="form-control gold-border" name="order_date">
                        </div>
                        <div class="col-md-6">
                            <label class="green-text fw-bold">Delivery Date</label>
                            <input type="date" class="form-control gold-border" name="delivery_date">
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
                                <tr>
                                    <td><input type="text" class="form-control" name="items[0][name]"></td>
                                    <td><input type="number" class="form-control" name="items[0][quantity]"></td>
                                    <td><input type="number" step="0.01" class="form-control" name="items[0][unit_price]"></td>
                                    <td><span class="item-total">0.00</span></td>
                                    <td><button type="button" class="btn btn-sm btn-danger remove-item"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm gold-bg text-white" id="add-item">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                    </div>

                    <!-- Notes -->
                    <div class="form-group mb-4">
                        <label class="green-text fw-bold">Notes</label>
                        <textarea class="form-control gold-border" name="notes" rows="3"></textarea>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn gold-bg text-white">
                            <i class="fas fa-save"></i> Submit PO
                        </button>
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