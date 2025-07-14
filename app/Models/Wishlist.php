<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(RetailerInventory::class, 'product_id');
    }
    public function index()
{
    $wishlistItems = Wishlist::with('product')
        ->where('user_id', Auth::id())
        ->get();

    return view('customer.customer-wishlist', compact('wishlistItems'));
}



}
