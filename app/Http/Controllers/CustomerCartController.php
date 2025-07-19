<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Retailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Product; 
use App\Models\RetailerOrder;
use Illuminate\Support\Str;


class CustomerCartController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $cartItems = Cart::where('user_id', $user->id)->get();

    $deliveryFee = 5000;
    $taxRate = 0.05;

    $cartTotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
    $tax = $cartTotal * $taxRate;
    $totalAmount = $cartTotal + $deliveryFee + $tax;

    $retailers = Retailer::all();
    $unreadCount = 0;

     $userId = auth()->id();
    $cartCount = Cart::where('user_id', $userId)->count();

    return view('dashboard.customer-cart', compact(
        'user', 'cartItems', 'deliveryFee', 'tax', 'totalAmount', 'retailers', 'unreadCount', 'cartCount'
    ));
}


 

public function addToCart(Request $request)
{
    try {
        $request->validate([
            'product_id' => 'nullable|integer',
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'product_image' => 'nullable|string',
        ]);

        $user = auth()->user();

        // Check if product already exists in cart
        $existing = Cart::where('user_id', $user->id)
            ->where('product_name', $request->product_name)
            ->first();

        if ($existing) {
            $existing->quantity += $request->quantity;
            $existing->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id ?? null,
                'product_name' => $request->product_name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'product_image' => $request->product_image,
            ]);
        }

        // 🔥 Remove from wishlist (by product_name match)
        \App\Models\Wishlist::where('user_id', $user->id)
            ->where('product_name', $request->product_name)
            ->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Product added to cart.'], 200);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    } catch (\Exception $e) {
        \Log::error('Cart Error: ' . $e->getMessage());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Error adding to cart'], 500);
        }

        return redirect()->back()->with('error', 'Failed to add product to cart.');
    }
}

  public function decreaseQuantity($id)
{
    $item = Cart::findOrFail($id);

    if ($item->quantity > 1) {
        $item->quantity--;
        $item->save();
    } else {
        $item->delete(); // Or decide what to do if quantity is 1
    }

    return redirect()->back()->with('message', 'Quantity updated.');
}
   public function increaseQuantity($id)
{
    $item = Cart::findOrFail($id);
    $item->quantity += 1;
    $item->save();

    return redirect()->back()->with('message', 'Item quantity increased.');
}
  public function removeItem($id)
{
    $item = \App\Models\Cart::findOrFail($id);
    $item->delete();

    return redirect()->back()->with('message', 'Item removed from cart.');
}

public function checkout(Request $request)
{
    $request->validate([
        'retailer_id' => 'required|exists:retailers,id',
    ]);

    $user = Auth::user();
    $cartItems = Cart::where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return back()->with('error', 'Your cart is empty.');
    }

   do {
    $transactionId = 'GF-' . mt_rand(1000, 9999);
} while (RetailerOrder::where('transaction_id', $transactionId)->exists());

    $retailerId = $request->input('retailer_id');

    foreach ($cartItems as $item) {
        RetailerOrder::create([
            'transaction_id' => $transactionId,
            'retailer_id' => $retailerId,
            'user_id' => $user->id,
            'product_id' => $item->product_id,
            'product_name' => $item->product_name,
            'product_image' => $item->product_image,
            'quantity' => $item->quantity,
            'price' => $item->price,
            'total' => $item->price * $item->quantity,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    Cart::where('user_id', $user->id)->delete();

    return redirect()->route('customer.cart')->with('success', 'Order placed successfully!');
}


}
