<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WholesalerInventory extends Model
{
  
    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'units',
        'unit_price',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}


