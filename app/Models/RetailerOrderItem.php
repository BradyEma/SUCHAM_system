<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailerOrderItem extends Model
{
    protected $fillable = ['retailer_order_id', 'product_id', 'quantity', 'price_per_unit', 'subtotal'];

    public function order()
    {
        return $this->belongsTo(RetailerOrder::class, 'retailer_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


