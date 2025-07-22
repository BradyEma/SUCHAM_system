<div class="gf-container" style="background: linear-gradient(to bottom, #FFFFFF, #FFF9E6); padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 900px; margin: 0 auto;">
    <div class="gf-header" style="border-bottom: 2px solid #FFD700; padding-bottom: 15px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
        <h2 style="color: #006400;">Edit Goods Received Note <span style="color: #777; font-size: 16px;">GRN-2023-001</span></h2>
        <span class="gf-status-badge" style="background-color: #90EE90; color: #006400; padding: 5px 15px; border-radius: 15px; font-size: 14px; font-weight: bold;">Approved</span>
    </div>
    
    <form>
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Basic Information</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">PO Reference</label>
                    <input type="text" value="PO-2023-045" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; background-color: #F5F5F5;" readonly>
                </div>
                
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Received Date</label>
                    <input type="date" value="2023-10-15" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px;">
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Received By</label>
                    <input type="text" value="John Doe" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px;" readonly>
                </div>
                
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Approved By</label>
                    <input type="text" value="Jane Smith" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px;" readonly>
                </div>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Received Items</h3>
            
            <div class="gf-items-table" style="margin-top: 15px; border: 1px solid #EEE; border-radius: 6px; overflow: hidden;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: #F5F5F5;">
                        <tr>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Item</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Ordered Qty</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Received Qty</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Unit</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #FFD700;">Condition</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #EEE;">
                            <td style="padding: 12px;">Steel Beams (25mm)</td>
                            <td style="padding: 12px;">100</td>
                            <td style="padding: 12px;"><input type="number" value="98" style="width: 80px; padding: 5px; border: 1px solid #DDD; border-radius: 4px;"></td>
                            <td style="padding: 12px;">Pieces</td>
                            <td style="padding: 12px;">
                                <select style="padding: 5px; border: 1px solid #DDD; border-radius: 4px;">
                                    <option>Good</option>
                                    <option selected>Partial Damage</option>
                                    <option>Damaged</option>
                                </select>
                            </td>
                        </tr>
                        <!-- Additional items would follow the same pattern -->
                    </tbody>
                </table>
            </div>
            
            <div class="gf-form-group" style="margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Damage Notes</label>
                <textarea style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; min-height: 80px;">2 pieces arrived with minor dents, acceptable for non-critical applications.</textarea>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Attachments</h3>
            
            <div class="gf-attachments" style="margin-top: 15px;">
                <div style="display: flex; align-items: center; padding: 10px; border: 1px solid #EEE; border-radius: 4px; margin-bottom: 10px;">
                    <div style="background-color: #FFD700; color: #006400; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 4px; margin-right: 15px;">
                        <i class="fas fa-file-pdf" style="font-size: 20px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: bold;">delivery_note_1015.pdf</div>
                        <div style="font-size: 12px; color: #777;">Uploaded on 15 Oct 2023</div>
                    </div>
                    <button style="background: none; border: none; color: #777; cursor: pointer;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                
                <div style="border: 2px dashed #DDD; padding: 15px; text-align: center; border-radius: 6px; background-color: #FAFAFA; margin-top: 15px;">
                    <p style="color: #777;">Add more files if needed</p>
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
                Update Goods Received Note
            </button>
        </div>
    </form>
</div>