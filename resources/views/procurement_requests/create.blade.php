<div class="gf-container" style="background: linear-gradient(to bottom, #FFFFFF, #FFF9E6); padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 1000px; margin: 0 auto;">
    <div class="gf-header" style="border-bottom: 2px solid #FFD700; padding-bottom: 15px; margin-bottom: 20px;">
        <h2 style="color: #006400;">New Procurement Request</h2>
        <p style="color: #777; margin-top: 5px;">Fill out this form to request procurement of goods or services</p>
    </div>
    
    <form>
    <form method="GET" action="{{ route('procurement-requests.index') }}">
    <input 
        type="text" 
        name="search" 
        value="{{ old('search', $search ?? '') }}" 
        placeholder="Search requests..." 
    />
    <button type="submit">Search</button>
</form>

        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Request Information</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Request Type</label>
                    <select style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; background-color: white;">
                        <option>Select Request Type</option>
                        <option>Goods</option>
                        <option>Services</option>
                        <option>Equipment</option>
                        <option>Raw materials</option>
                    </select>
                </div>
                
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Priority</label>
                    <select style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; background-color: white;">
                        <option>Normal</option>
                        <option>High</option>
                        <option>Urgent</option>
                    </select>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Required By Date</label>
                    <input type="date" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px;">
                </div>
                
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Department</label>
                    <select style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; background-color: white;">
                        <option>Manufacturing</option>
                        <option>Packaging</option>
                        <option>Sales</option>
                        <option>Marketing</option>
                    </select>
                </div>
            </div>
            
            <div class="gf-form-group" style="margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Purpose/Justification</label>
                <textarea style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px; min-height: 80px;" placeholder="Explain why this procurement is necessary..."></textarea>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Request Items</h3>
            
            <div class="gf-items-container" style="margin-top: 15px; border: 1px solid #EEE; border-radius: 6px; padding: 15px;">
                <div class="gf-item-header" style="display: grid; grid-template-columns: 3fr 1fr 1fr 1fr 1fr 1fr; gap: 10px; margin-bottom: 15px; font-weight: bold; color: #006400;">
                    <div>Item Description</div>
                    <div>Quantity</div>
                    <div>Unit</div>
                    <div>Unit Price</div>
                    <div>Total</div>
                    <div></div>
                </div>
                
                <div class="gf-item-row" style="display: grid; grid-template-columns: 3fr 1fr 1fr 1fr 1fr 1fr; gap: 10px; margin-bottom: 15px; align-items: center;">
                    <div><input type="text" placeholder="Item name and description" style="width: 100%; padding: 8px; border: 1px solid #DDD; border-radius: 4px;"></div>
                    <div><input type="number" placeholder="Qty" style="width: 100%; padding: 8px; border: 1px solid #DDD; border-radius: 4px;"></div>
                    <div>
                        <select style="width: 100%; padding: 8px; border: 1px solid #DDD; border-radius: 4px;">
                            <option>Bags</option>
                            <option>Boxes</option>
                            <option>Kg</option>
                            <option>Liter</option>
                            <option>Grams</option>
                            <option>Milliters</option>
                        </select>
                    </div>
                    <div><input type="text" placeholder="0.00" style="width: 100%; padding: 8px; border: 1px solid #DDD; border-radius: 4px;"></div>
                    <div style="padding: 8px; text-align: right;">UG shs0.00</div>
                    <div style="text-align: center;">
                        <button style="background: none; border: none; color: #FF6B6B; cursor: pointer;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                
                <button class="gf-btn-secondary" style="background-color: #006400; color: white; border: none; padding: 8px 15px; border-radius: 4px; margin-top: 10px;">
                    <i class="fas fa-plus"></i> Add Another Item
                </button>
                
                <div class="gf-totals" style="margin-top: 20px; text-align: right;">
                    <div style="display: inline-block; text-align: left;">
                        <div style="margin-bottom: 5px;">Subtotal: <span style="font-weight: bold;">UG shs0.00</span></div>
                        <div style="margin-bottom: 5px;">Tax (10%): <span style="font-weight: bold;">UG shs0.00</span></div>
                        <div style="font-size: 18px; color: #006400;">Estimated Total: <span style="font-weight: bold;">UG shs0.00</span></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="gf-form-section" style="margin-bottom: 25px;">
            <h3 style="color: #006400; border-left: 4px solid #FFD700; padding-left: 10px;">Additional Information</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Preferred Supplier</label>
                    <input type="text" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px;" placeholder="If you have a preferred supplier">
                </div>
                
                <div class="gf-form-group">
                    <label style="display: block; margin-bottom: 5px; color: #555; font-weight: bold;">Budget Code</label>
                    <input type="text" style="width: 100%; padding: 10px; border: 1px solid #DDD; border-radius: 4px;" placeholder="Enter budget code if applicable">
                </div>
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
                Save Draft
            </button>
            <button class="gf-btn-primary" style="background-color: #FFD700; color: #006400; border: none; padding: 10px 20px; border-radius: 4px; font-weight: bold;">
                Submit for Approval
            </button>
        </div>
    </form>
</div>