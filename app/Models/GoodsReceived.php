<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsReceived extends Model
{
    // 🔧 Tell Laravel the correct table name
    protected $table = 'goods_received';

    protected $fillable = [
        'purchase_order_id',
        'received_date',
        'received_by',
        'received_items',
        'notes',
    ];

     public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function items()
    {
        return $this->hasMany(GoodsReceivedItem::class);
    }
}
