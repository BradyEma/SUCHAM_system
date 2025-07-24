<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Order - GoldenFields</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .gold-gradient {
            background: linear-gradient(135deg, #FFD700 0%, #D4AF37 100%);
        }
        .green-gradient {
            background: linear-gradient(135deg, #006400 0%, #228B22 100%);
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white">
    <div class="min-h-screen" x-data="orderForm()" x-cloak>
        <!-- Header -->
        <header class="bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-md">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-green-800">
                        Create New Order
                    </h1>
                    <a href="{{ route('retailer_wholesaler_orders.index') }}" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg flex items-center transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Orders
                    </a>
                </div>
            </div>
        </header>
        
        <!-- Main Form -->
        <main class="container mx-auto px-4 py-8">
            <form method="POST" action="{{ route('retailer_wholesaler_orders.store') }}" @submit.prevent="submitOrder">
                @csrf
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                    <!-- Form Header -->
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Order Details</h2>
                    </div>

                    <!-- Retailer Information -->
                    <div class="p-6 border-b border-gray-200">
                        <label class="block text-green-800 font-medium mb-2">Retailer Information</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm mb-1">Your Business Name</label>
                                <input type="text" 
                                       name="business_name"
                                       value="{{ old('business_name', 'Golden Harvest Market') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600"
                                       placeholder="Enter your business name">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm mb-1">Wholesaler</label>
                                <select name="wholesaler_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                    <option value="1">Golden Fields Wholesale</option>
                                    <option value="2">Harvest Time Suppliers</option>
                                    <option value="3">Organic Farm Distributors</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Product Selection -->
                    <div class="p-6 border-b border-gray-200">
                        <label class="block text-green-800 font-medium mb-2">Add Products</label>
                        
                        <div class="flex flex-col md:flex-row gap-4 mb-4">
                            <!-- Product Name Input -->
                            <div class="flex-1">
                                <label class="block text-gray-700 text-sm mb-1">Product Name</label>
                                <input type="text" x-model="manualProductName" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600" 
                                       placeholder="Enter product name">
                            </div>

                            <!-- Price Input -->
                            <div>
                                <label class="block text-gray-700 text-sm mb-1">Price (Ugshs)</label>
                                <input type="number" x-model="manualProductPrice" min="0" step="0.01"
                                       class="w-24 px-4 py-2 border border-gray-300 rounded-lg">
                            </div>

                            <!-- Quantity Input -->
                            <div>
                                <label class="block text-gray-700 text-sm mb-1">Quantity</label>
                                <input type="number" x-model="quantity" min="0.01" step="0.01"
                                       class="w-24 px-4 py-2 border border-gray-300 rounded-lg">
                            </div>

                            <!-- Unit Selection -->
                            <div>
                                <label class="block text-gray-700 text-sm mb-1">Unit</label>
                                <select x-model="selectedUnit" class="w-24 px-4 py-2 border border-gray-300 rounded-lg">
                                    <option value="kg">kg</option>
                                    <option value="g">g</option>
                                    <option value="l">l</option>
                                    <option value="pcs">pcs</option>
                                    <option value="box">box</option>
                                    <option value="pack">pack</option>
                                    <option value="bag">bag</option>
                                    
                                </select>
                            </div>

                            <!-- Add Button -->
                            <div class="flex items-end">
                                <button type="button" @click="addProduct()" 
                                        class="gold-gradient hover:bg-amber-600 text-green-800 font-bold py-2 px-6 rounded-lg">
                                    Add to Order
                                </button>
                            </div>
                        </div>

                        <!-- Inventory Alert -->
                        <div x-show="inventoryError" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded">
                            <p x-text="inventoryError"></p>
                        </div>
                    </div>

                    <!-- Order Items Table -->
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-green-800 font-medium mb-4">Order Items</h3>
                        
                        <template x-if="orderItems.length === 0">
                            <div class="bg-gray-50 text-gray-700 p-4 rounded-lg text-center">
                                No products added yet. Select products above to begin.
                            </div>
                        </template>

                        <template x-if="orderItems.length > 0">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-green-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Product</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Price</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Qty</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Total</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <template x-for="(item, index) in orderItems" :key="index">
                                            <tr>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="hidden" :name="'items[' + index + '][name]'" x-model="item.name">
                                                    <span x-text="item.name"></span>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="hidden" :name="'items[' + index + '][price]'" x-model="item.price">
                                                    Ugshs <span x-text="item.price.toFixed(2)"></span>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="hidden" :name="'items[' + index + '][quantity]'" x-model="item.quantity">
                                                    <input type="hidden" :name="'items[' + index + '][unit]'" x-model="item.unit">
                                                    <span x-text="item.quantity"></span>
                                                    <span x-text="item.unit" class="text-gray-500 ml-1"></span>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    Ugshs <span x-text="(item.price * item.quantity).toFixed(2)"></span>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <button type="button" @click="removeItem(index)" class="text-red-600 hover:text-red-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    <tfoot class="bg-green-50 font-bold">
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right">Subtotal:</td>
                                            <td class="px-4 py-3">Ugshs <span x-text="calculateSubtotal().toFixed(2)"></span></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right">Tax (10%):</td>
                                            <td class="px-4 py-3">Ugshs <span x-text="calculateTax().toFixed(2)"></span></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right text-green-800">Grand Total:</td>
                                            <td class="px-4 py-3 text-green-800">
                                                <input type="hidden" name="total_amount" x-model="calculateTotal()">
                                                Ugshs <span x-text="calculateTotal().toFixed(2)"></span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </template>
                    </div>

                    <!-- Delivery & Notes -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-green-800 font-medium mb-2">Delivery Date</label>
                                <input type="date" name="delivery_date" x-model="deliveryDate" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-green-800 font-medium mb-2">Delivery Address</label>
                                <select name="delivery_address" x-model="deliveryAddress" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                    <option value="main_store">Main Store: 123 Farm Rd, Golden Valley</option>
                                    <option value="warehouse">Warehouse: 456 Harvest Ave, Greenfield</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-green-800 font-medium mb-2">Notes</label>
                            <textarea name="notes" x-model="notes" rows="3" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg" 
                                      placeholder="Special instructions..."></textarea>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="bg-gray-50 p-6 flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <label class="inline-flex items-center">
                                <input type="checkbox" x-model="termsAccepted" 
                                       class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <span class="ml-2 text-gray-700">I confirm this order is correct</span>
                            </label>
                        </div>
                        <button 
                            type="submit"
                            :disabled="orderItems.length === 0 || !termsAccepted"
                            :class="{
                                'bg-gray-400 text-gray-600 cursor-not-allowed': orderItems.length === 0 || !termsAccepted, 
                                'green-gradient text-white hover:from-green-700 hover:to-green-800': orderItems.length > 0 && termsAccepted
                            }"
                            class="font-bold py-3 px-8 rounded-lg shadow-md transition">
                            Submit Order
                        </button>
                    </div>
                </div>
            </form>
        </main>

        <!-- Success Modal -->
        <div x-show="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-green-800 mt-3">Order Submitted Successfully!</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-700">
                            Your order #<span x-text="newOrderId"></span> has been placed. 
                            A confirmation has been sent to your email.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

   <script>
    function orderForm() {
        return {
            // Form Data
            manualProductName: '',
            manualProductPrice: 0,
            quantity: 1,
            selectedUnit: 'kg',
            deliveryDate: new Date().toISOString().split('T')[0],
            deliveryAddress: 'main_store',
            notes: '',
            termsAccepted: false,
            inventoryError: '',
            
            orderItems: [],
            
            // Modal State
            showSuccessModal: false,
            newOrderId: 'GF-' + Math.floor(1000 + Math.random() * 9000),
            
            // Methods
            addProduct() {
                // Clear previous errors
                this.inventoryError = '';
                
                // Validation
                if (!this.manualProductName || this.manualProductName.trim() === '') {
                    this.inventoryError = 'Please enter a product name';
                    return;
                }
                
                if (this.manualProductPrice <= 0 || isNaN(this.manualProductPrice)) {
                    this.inventoryError = 'Price must be greater than 0';
                    return;
                }
                
                if (this.quantity <= 0 || isNaN(this.quantity)) {
                    this.inventoryError = 'Quantity must be greater than 0';
                    return;
                }
                
                // Add to order items
                this.orderItems.push({
                    id: Date.now(), // Temporary ID
                    name: this.manualProductName,
                    price: parseFloat(this.manualProductPrice),
                    quantity: parseFloat(this.quantity),
                    unit: this.selectedUnit
                });
                
                // Reset form
                this.manualProductName = '';
                this.manualProductPrice = 0;
                this.quantity = 1;
                this.selectedUnit = 'kg';
            },
            
            removeItem(index) {
                this.orderItems.splice(index, 1);
            },
            
            calculateSubtotal() {
                return this.orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            },
            
            calculateTax() {
                return this.calculateSubtotal() * 0.10;
            },
            
            calculateTotal() {
                return this.calculateSubtotal() + this.calculateTax();
            },
            
            submitOrder() {
                if (this.orderItems.length === 0) {
                    this.inventoryError = 'Please add at least one product';
                    return false;
                }

                if (!this.termsAccepted) {
                    this.inventoryError = 'You must confirm the order';
                    return false;
                }

                const form = this.$el.querySelector('form');
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.newOrderId = data.order_id;
                        this.showSuccessModal = true;
                        setTimeout(() => {
                            window.location.href = "{{ route('retailer_wholesaler_orders.index') }}";
                        }, 3000);
                    } else {
                        this.inventoryError = data.message || 'Order failed to save.';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.inventoryError = 'An error occurred while submitting the order';
                });
            }
        }
    }
</script>
</body>
</html>