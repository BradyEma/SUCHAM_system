<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
   public function index()
{
    $wishlistItems = Wishlist::where('user_id', auth()->id())->get();
    return view('dashboard.customer-wishlist', compact('wishlistItems'));
}


    public function store(Request $request)
{
    $userId = auth()->id();

    $exists = Wishlist::where('user_id', $userId)
                      ->where('product_name', $request->input('product_name'))
                      ->exists();

    if ($exists) {
        return response()->json(['message' => 'Already in wishlist'], 409);
    }

    try {
        Wishlist::create([
            'user_id'       => $userId,
            'product_name'  => $request->input('product_name'),
            'product_image' => $request->input('product_image'),
            'price'         => $request->input('price'),
        ]);

        return response()->json(['message' => 'Added to wishlist']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Server Error', 'error' => $e->getMessage()], 500);
    }
}




    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        if ($wishlist->user_id === Auth::id()) {
            $wishlist->delete();
            return back()->with('success', 'Item removed from wishlist.');
        }

        return back()->with('error', 'Unauthorized.');
    }
}
