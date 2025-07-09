<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailerInventory extends Model
{
        protected $fillable = [
         'retailer_id','product_name', 'product_id', 'stock', 'unit_price', 'measurements', 'status'
    ];

}
