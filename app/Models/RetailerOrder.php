<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailerOrder extends Model
{
  
    protected $fillable = [
        'retailer_id', 'wholesaler_id', 'order_status',
        'total_amount', 'order_date', 'delivery_date'
    ];

    public function retailer()
    {
        return $this->belongsTo(User::class, 'retailer_id');
    }

    public function wholesaler()
    {
        return $this->belongsTo(User::class, 'wholesaler_id');
    }

    public function items()
    {
        return $this->hasMany(RetailerOrderItem::class);
    }
}


