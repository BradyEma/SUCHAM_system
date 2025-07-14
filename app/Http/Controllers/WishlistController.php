<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\RetailerInventory;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('dashboard.customer-wishlist', compact('wishlistItems'));
    }

    public function store($productId)
    {
        $user = Auth::user();

        if (Wishlist::where('user_id', $user->id)->where('product_id', $productId)->exists()) {
            return back()->with('info', 'Product is already in your wishlist.');
        }

        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Added to wishlist!');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        if ($wishlist->user_id == Auth::id()) {
            $wishlist->delete();
            return back()->with('success', 'Item removed from wishlist.');
        }

        return back()->with('error', 'Unauthorized.');
    }

    public function add(Request $request)
{
    $userId = auth()->id();
    $productId = $request->input('product_id');

    // Check if product already in wishlist
    $exists = Wishlist::where('user_id', $userId)
                      ->where('product_id', $productId)
                      ->exists();

    if ($exists) {
        return response()->json(['message' => 'Already in wishlist'], 409); // Conflict
    }

    Wishlist::create([
        'user_id' => $userId,
        'product_id' => $productId,
    ]);

    return response()->json(['message' => 'Added to wishlist']);
}
}
