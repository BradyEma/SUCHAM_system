<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Retailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Product; 


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

    return view('dashboard.customer-cart', compact(
        'user', 'cartItems', 'deliveryFee', 'tax', 'totalAmount', 'retailers', 'unreadCount'
    ));
}


 

public function addToCart(Request $request)
{
    try {
        $request->validate([
            'product_id' => 'required|integer',
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'product_image' => 'required|string',
        ]);

        $user = Auth::user();

        $existing = Cart::where('user_id', $user->id)
            ->where('product_name', $request->product_name)
            ->first();

        if ($existing) {
            $existing->quantity += $request->quantity;
            $existing->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'product_name' => $request->product_name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'product_image' => $request->product_image,
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    } catch (\Exception $e) {
        \Log::error('Cart Error: ' . $e->getMessage());
        return response()->json(['message' => 'Error adding to cart'], 500);
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

}
