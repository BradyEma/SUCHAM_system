<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'retailer_id',
        'product_name',
        'sku',
        'quantity',
        'unit_of_measurement',
        'unit_price',
        'minimum_stock_level',
        'product_description',
        'product_image',
    ];

    // ✅ Each inventory item belongs to a retailer
    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
