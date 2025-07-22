<div class="gf-container" style="background: #FFFFFF; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); max-width: 900px; margin: 0 auto; border: 1px solid #EAEAEA;">
    <div class="gf-header" style="border-bottom: 2px solid #FFD700; padding-bottom: 15px; margin-bottom: 20px;">
        <h2 style="color: #348834ff; font-weight: 600;">Goods Received Note</h2>
    </div>
    
    <form method="POST" action="{{ route('goods-received.store') }}">
    @csrf
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #1d701dff; border-left: 4px solid #f7d40dff; padding-left: 10px; font-weight: 500;">Basic Information</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: 500;">PO Reference</label>
<select name="purchase_order_id" style="width: 100%; padding: 10px; border: 1px solid #E0E0E0; border-radius: 4px; background-color: white; font-size: 14px;" required>
    <option value="">Select Purchase Order</option>
    @foreach ($purchaseOrders as $order)
        <option value="{{ $order->id }}">
            {{ $order->reference_number }} - {{ $order->supplier->name }}
        </option>
    @endforeach
</select>

                </div>
                
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: 500;">Received Date</label>
                    <input type="date" style="width: 100%; padding: 10px; border: 1px solid #E0E0E0; border-radius: 4px; background-color: white; font-size: 14px;">
                </div>
            </div>
            
            <div class="gf-form-group" style="margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #555; font-weight: 500;">Received By</label>
                <input type="text" style="width: 100%; padding: 10px; border: 1px solid #E0E0E0; border-radius: 4px; background-color: #F8F8F8; font-size: 14px;  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1); /* Added subtle inset shadow */
                  transition: border-color 0.3s ease;" /* Added transition */
           placeholder="Enter your name and position" 
           required>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px; font-weight: 500;">Received Items</h3>
            
            <div class="gf-items-table" style="margin-top: 15px; border: 1px solid #EEE; border-radius: 6px; overflow: hidden; background-color: white;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700; font-weight: 500;"> Purchase order Item</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700; font-weight: 500;">Ordered Qty</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700; font-weight: 500;">Received Qty</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700; font-weight: 500;">Unit
                                <select style="padding: 5px; border: 1px solid #E0E0E0; border-radius: 4px; width: 100%; background-color: white; margin-top: 5px;">
                                    <option>Pieces</option>
                                    <option>Bags</option>
                                    <option>Boxes</option>
                                    <option>Trucks</option>
                                    <option>Kilograms</option>
                                    <option>Litres</option>
                                </select>
                            </th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700; font-weight: 500;">Condition
                                <select style="padding: 5px; border: 1px solid #E0E0E0; border-radius: 4px; width: 100%; background-color: white; margin-top: 5px;">
                                    <option>Good</option>
                                    <option>Damaged</option>
                                    <option>Partial Damage</option>
                                </select>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="items-table-body">
                        <!-- Your existing item rows will be here -->
                    </tbody>
                </table>
                
                <!-- Add Item Button -->
                <div style="padding: 10px; background-color: #F8F8F8; text-align: right;">
                    <button type="button" onclick="addNewItemRow()" style="background-color: #006400; color: white; border: none; padding: 8px 15px; border-radius: 4px; font-size: 14px; cursor: pointer;">
                        + Add Another Item
                    </button>
                </div>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px; font-weight: 500;">Notes</h3>
            
            <div class="gf-form-group" style="margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #555; font-weight: 500;">Notes</label>
                <textarea style="width: 100%; padding: 10px; border: 1px solid #E0E0E0; border-radius: 4px; min-height: 100px; background-color: white; font-size: 14px;" placeholder="Any additional notes about the received goods..."></textarea>
            </div>
            
    
        </div>
        
        <div class="gf-form-actions" style="text-align: right; border-top: 1px solid #EEE; padding-top: 20px;">
            <button class="gf-btn-secondary" style="background-color: #F8F8F8; border: 1px solid #E0E0E0; padding: 10px 20px; border-radius: 4px; margin-right: 10px; font-size: 14px; cursor: pointer;">
                Cancel
            </button>
            <button class="gf-btn-primary" style="background-color: #FFD700; color: #006400; border: none; padding: 10px 20px; border-radius: 4px; font-weight: 500; font-size: 14px; cursor: pointer;">
                Save Goods Received Note
            </button>
        </div>
    </form>
</div>

<script>
function addNewItemRow() {
    // Get the table body
    const tbody = document.getElementById('items-table-body');
    
    // Create a new row
    const newRow = document.createElement('tr');
    newRow.style.borderBottom = '1px solid #EEE';
    
    // Set the HTML for the new row
    newRow.innerHTML = `
        <td style="padding: 12px;">
            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #E0E0E0; border-radius: 4px; background-color: white; font-size: 14px;" placeholder="Item name">
        </td>
        <td style="padding: 12px;">
            <input type="number" style="width: 100%; padding: 8px; border: 1px solid #E0E0E0; border-radius: 4px; background-color: white; font-size: 14px;" placeholder="0">
        </td>
        <td style="padding: 12px;">
            <input type="number" style="width: 100%; padding: 8px; border: 1px solid #E0E0E0; border-radius: 4px; background-color: white; font-size: 14px;" placeholder="0">
        </td>
        <td style="padding: 12px;">
            <select style="padding: 8px; border: 1px solid #E0E0E0; border-radius: 4px; width: 100%; background-color: white; font-size: 14px;">
                <option>Pieces</option>
                <option>Boxes</option>
                <option>Trucks</option>
                <option>Kilograms</option>
                <option>Litres</option>
            </select>
        </td>
        <td style="padding: 12px;">
            <select style="padding: 8px; border: 1px solid #E0E0E0; border-radius: 4px; width: 100%; background-color: white; font-size: 14px;">
                <option>Good</option>
                <option>Damaged</option>
                <option>Partial Damage</option>
            </select>
        </td>
    `;
    
    // Add the new row to the table
    tbody.appendChild(newRow);
    
    // Scroll to the new row
    newRow.scrollIntoView({ behavior: 'smooth' });
}
</script>