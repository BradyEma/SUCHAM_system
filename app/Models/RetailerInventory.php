<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailerInventory extends Model
{
        protected $fillable = [
         'product_name', 'product_id', 'stock', 'unit_price', 'measurements', 'status'
    ];

}
