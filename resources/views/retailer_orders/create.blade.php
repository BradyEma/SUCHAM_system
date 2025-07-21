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
<body class="bg-amber-50">
    <div class="min-h-screen" x-data="orderForm()" x-cloak>
        <!-- Header -->
        <header class="gold-gradient shadow-md">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-green-800">
                        <span class="inline-block mr-2">🌾</span>
                        Create New Order
                    </h1>
                    <a href="{{ route('retailer_orders.index') }}" class="bg-green-800 hover:bg-green-900 text-amber-100 px-4 py-2 rounded-lg flex items-center">
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
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Form Header -->
                <div class="green-gradient px-6 py-4">
                    <h2 class="text-xl font-bold text-amber-100">Order Details</h2>
                </div>

                <!-- Customer Selection -->
                <div class="p-6 border-b border-amber-200">
                    <label class="block text-green-800 font-medium mb-2">Retailer Information</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-amber-800 text-sm mb-1">Your Business Name</label>
                            <input type="text" value="Golden Harvest Market" readonly 
                                   class="w-full px-4 py-2 border border-amber-300 rounded-lg bg-amber-50">
                        </div>
                        <div>
                            <label class="block text-amber-800 text-sm mb-1">Account ID</label>
                            <input type="text" value="GF-RTL-2048" readonly 
                                   class="w-full px-4 py-2 border border-amber-300 rounded-lg bg-amber-50">
                        </div>
                    </div>
                </div>

                <!-- Product Selection -->
                <div class="p-6 border-b border-amber-200">
                    <label class="block text-green-800 font-medium mb-2">Add Products</label>
                    
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block text-amber-800 text-sm mb-1">Product</label>
                            <select x-model="selectedProduct" @change="updateProductInfo()" 
                                    class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:ring-2 focus:ring-green-600">
                                <option value="">Select a product</option>
                                <template x-for="product in availableProducts" :key="product.id">
                                    <option :value="product.id" 
                                            :data-price="product.price" 
                                            :data-stock="product.stock">
                                        <span x-text="product.name"></span> 
                                        (<span x-text="product.stock"></span> available)
                                    </option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-amber-800 text-sm mb-1">Quantity</label>
                            <input type="number" x-model="quantity" min="1" 
                                   class="w-24 px-4 py-2 border border-amber-300 rounded-lg">
                        </div>
                        <div class="flex items-end">
                            <button @click="addProduct()" 
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
                <div class="p-6 border-b border-amber-200">
                    <h3 class="text-green-800 font-medium mb-4">Order Items</h3>
                    
                    <template x-if="orderItems.length === 0">
                        <div class="bg-amber-50 text-amber-800 p-4 rounded-lg text-center">
                            No products added yet. Select products above to begin.
                        </div>
                    </template>

                    <template x-if="orderItems.length > 0">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-amber-200">
                                <thead class="bg-green-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Product</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Price</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Qty</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Total</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-amber-200">
                                    <template x-for="(item, index) in orderItems" :key="index">
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap" x-text="item.name"></td>
                                            <td class="px-4 py-3 whitespace-nowrap">$<span x-text="item.price.toFixed(2)"></span></td>
                                            <td class="px-4 py-3 whitespace-nowrap" x-text="item.quantity"></td>
                                            <td class="px-4 py-3 whitespace-nowrap">$<span x-text="(item.price * item.quantity).toFixed(2)"></span></td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <button @click="removeItem(index)" class="text-red-600 hover:text-red-800">
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
                                        <td class="px-4 py-3">$<span x-text="calculateSubtotal().toFixed(2)"></span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-right">Tax (10%):</td>
                                        <td class="px-4 py-3">$<span x-text="calculateTax().toFixed(2)"></span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-right text-green-800">Grand Total:</td>
                                        <td class="px-4 py-3 text-green-800">$<span x-text="calculateTotal().toFixed(2)"></span></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </template>
                </div>

                <!-- Delivery & Notes -->
                <div class="p-6 border-b border-amber-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-green-800 font-medium mb-2">Delivery Date</label>
                            <input type="date" x-model="deliveryDate" 
                                   class="w-full px-4 py-2 border border-amber-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-green-800 font-medium mb-2">Delivery Address</label>
                            <select x-model="deliveryAddress" 
                                    class="w-full px-4 py-2 border border-amber-300 rounded-lg">
                                <option value="main_store">Main Store: 123 Farm Rd, Golden Valley</option>
                                <option value="warehouse">Warehouse: 456 Harvest Ave, Greenfield</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-green-800 font-medium mb-2">Notes</label>
                        <textarea x-model="notes" rows="3" 
                                  class="w-full px-4 py-2 border border-amber-300 rounded-lg" 
                                  placeholder="Special instructions..."></textarea>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="bg-amber-50 p-6 flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <label class="inline-flex items-center">
                            <input type="checkbox" x-model="termsAccepted" 
                                   class="rounded border-amber-300 text-green-600 focus:ring-green-500">
                            <span class="ml-2 text-amber-800">I confirm this order is correct</span>
                        </label>
                    </div>
                    <button @click="submitOrder()" 
                            :disabled="orderItems.length === 0 || !termsAccepted"
                            :class="{'bg-gray-400 cursor-not-allowed': orderItems.length === 0 || !termsAccepted, 
                                     'green-gradient hover:bg-green-800': orderItems.length > 0 && termsAccepted}"
                            class="text-amber-100 font-bold py-3 px-8 rounded-lg shadow-md transition">
                        Submit Order
                    </button>
                </div>
            </div>
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
                        <p class="text-sm text-amber-800">
                            Your order #<span x-text="newOrderId"></span> has been placed. 
                            A confirmation has been sent to your email.
                        </p>
                    </div>
                    <div class="mt-4">
                        <button @click="redirectToOrders()" 
                                class="gold-gradient hover:bg-amber-600 text-green-800 font-bold py-2 px-6 rounded-lg">
                            View Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function orderForm() {
            return {
                // Form Data
                selectedProduct: '',
                quantity: 1,
                deliveryDate: new Date().toISOString().split('T')[0],
                deliveryAddress: 'main_store',
                notes: '',
                termsAccepted: false,
                inventoryError: '',
                
                // Mock Data - Replace with actual data from your backend
                availableProducts: [
                    { id: 1, name: 'Organic Golden Honey', price: 12.99, stock: 45 },
                    { id: 2, name: 'Premium Wheat Flour', price: 8.50, stock: 120 },
                    { id: 3, name: 'Cold-Pressed Olive Oil', price: 18.75, stock: 32 },
                    { id: 4, name: 'Farm Fresh Eggs (Dozen)', price: 6.99, stock: 89 },
                    { id: 5, name: 'Artisan Sourdough Bread', price: 5.25, stock: 14 }
                ],
                
                orderItems: [],
                
                // Modal State
                showSuccessModal: false,
                newOrderId: 'GF-' + Math.floor(1000 + Math.random() * 9000),
                
                // Methods
                updateProductInfo() {
                    this.inventoryError = '';
                },
                
                addProduct() {
                    if (!this.selectedProduct) {
                        this.inventoryError = 'Please select a product';
                        return;
                    }
                    
                    const product = this.availableProducts.find(p => p.id == this.selectedProduct);
                    
                    if (this.quantity < 1) {
                        this.inventoryError = 'Quantity must be at least 1';
                        return;
                    }
                    
                    if (this.quantity > product.stock) {
                        this.inventoryError = `Only ${product.stock} units available for ${product.name}`;
                        return;
                    }
                    
                    // Check if product already exists in order
                    const existingItem = this.orderItems.find(item => item.id == this.selectedProduct);
                    if (existingItem) {
                        existingItem.quantity += parseInt(this.quantity);
                    } else {
                        this.orderItems.push({
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            quantity: parseInt(this.quantity)
                        });
                    }
                    
                    // Reset selection
                    this.selectedProduct = '';
                    this.quantity = 1;
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
                    // In a real app, this would send data to your backend
                    console.log('Submitting order:', {
                        items: this.orderItems,
                        deliveryDate: this.deliveryDate,
                        deliveryAddress: this.deliveryAddress,
                        notes: this.notes,
                        total: this.calculateTotal()
                    });
                    
                    // Show success modal
                    this.showSuccessModal = true;
                },
                
                redirectToOrders() {
                    window.location.href = "/retailer/orders";
                }
            }
        }
    </script>
</body>
</html>