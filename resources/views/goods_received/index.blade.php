<div class="gf-container" style="background: #FFF8E7; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 900px; margin: 0 auto;">
    <div class="gf-header" style="border-bottom: 2px solid #FFD700; padding-bottom: 15px; margin-bottom: 20px;">
        <h2 style="color: #006400;">Goods Received Note</h2>
    </div>
    
     <form action="{{ route('goods-received.create') }}" method="GET" style="display: inline;">
        <button type="submit"
                class="bg-green-700 text-yellow-300 font-semibold px-4 py-2 rounded hover:bg-green-800 transition">
            + Add Goods Received Note
        </button>
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Basic Information</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">PO Reference</label>
                    <select style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; background-color: white;">
                        <option>Select Purchase Order</option>
                        <option>PO-2023-045 - ABC Suppliers</option>
                        <option>PO-2023-046 - XYZ Corporation</option>
                    </select>
                </div>
                
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Received Date</label>
                    <input type="date" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; background-color: white;">
                </div>
            </div>
            
            <div class="gf-form-group" style="margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Received By</label>
                <input type="text" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; background-color: #F5F5F5;" value="Current User" readonly>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Received Items</h3>
            
            <div class="gf-items-table" style="margin-top: 15px; border: 1px solid #EEE; border-radius: 6px; overflow: hidden; background-color: white;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: #F5F5F5;">
                        <tr>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Item</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Ordered Qty</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Received Qty</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Unit
                                <select style="padding: 5px; border: 1px solid #DDD; border-radius: 4px; width: 100%; background-color: white;">
                                    <option>Pieces</option>
                                    <option>Boxes</option>
                                    <option>Trucks</option>
                                    <option>Kilograms</option>
                                    <option>Litres</option>
                                </select>
                            </th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Condition
                                <select style="padding: 5px; border: 1px solid #DDD; border-radius: 4px; width: 100%; background-color: white;">
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
                <div style="padding: 10px; background-color: #F5F5F5; text-align: right;">
                    <button type="button" onclick="addNewItemRow()" style="background-color: #006400; color: white; border: none; padding: 8px 15px; border-radius: 4px;">
                        + Add Another Item
                    </button>
                </div>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Additional Information</h3>
            
            <div class="gf-form-group" style="margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Notes</label>
                <textarea style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; min-height: 100px; background-color: white;" placeholder="Any additional notes about the received goods..."></textarea>
            </div>
            
            <div class="gf-form-group" style="margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Attachments</label>
                <div style="border: 2px dashed #DDD; padding: 20px; text-align: center; border-radius: 6px; background-color: #FAFAFA;">
                    <p style="color: #777;">Drag & drop files here or click to browse</p>
                    <button class="gf-btn-secondary" style="background-color: #006400; color: white; border: none; padding: 8px 15px; border-radius: 4px; margin-top: 10px;">
                        Select Files
                    </button>
                </div>
            </div>
        </div>
        
        <div class="gf-form-actions" style="text-align: right; border-top: 1px solid #EEE; padding-top: 20px;">
            <button class="gf-btn-secondary" style="background-color: #F5F5F5; border: 1px solid #DDD; padding: 10px 20px; border-radius: 4px; margin-right: 10px;">
                Cancel
            </button>
            <button class="gf-btn-primary" style="background-color: #FFD700; color: #006400; border: none; padding: 10px 20px; border-radius: 4px; font-weight: bold;">
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
            <input type="text" style="width: 100%; padding: 5px; border: 1px solid #DDD; border-radius: 4px; background-color: white;" placeholder="Item name">
        </td>
        <td style="padding: 12px;">
            <input type="number" style="width: 100%; padding: 5px; border: 1px solid #DDD; border-radius: 4px; background-color: white;" placeholder="0">
        </td>
        <td style="padding: 12px;">
            <input type="number" style="width: 100%; padding: 5px; border: 1px solid #DDD; border-radius: 4px; background-color: white;" placeholder="0">
        </td>
        <td style="padding: 12px;">
            <select style="padding: 5px; border: 1px solid #DDD; border-radius: 4px; width: 100%; background-color: white;">
                <option>Pieces</option>
                <option>Boxes</option>
                <option>Trucks</option>
                <option>Kilograms</option>
                <option>Litres</option>
            </select>
        </td>
        <td style="padding: 12px;">
            <select style="padding: 5px; border: 1px solid #DDD; border-radius: 4px; width: 100%; background-color: white;">
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