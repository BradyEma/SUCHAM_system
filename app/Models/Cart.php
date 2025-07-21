<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
    'user_id', 'product_name', 'price', 'quantity', 'product_id', 'product_image'
];

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
