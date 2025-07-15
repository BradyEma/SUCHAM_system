<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_name',
        'sku',
        'quantity',
        'unit_of_measurement',
        'unit_price',
        'supplier_email',
        'minimum_stock_level',
        'product_image',
        'product_description',
    ];
}
