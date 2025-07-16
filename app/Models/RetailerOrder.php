<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerOrder extends Model
{
    use HasFactory;

 protected $fillable = [
    'transaction_id',
    'retailer_id',
    'user_id',
    'product_id',
    'product_name',
    'product_image',
    'quantity',
    'price',
    'total',
    'status',
];



    // Relationships
    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function customer()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
