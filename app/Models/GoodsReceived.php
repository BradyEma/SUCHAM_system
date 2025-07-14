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
        'notes'
    ];

    public function purchaseOrderItem()
    {
        return $this->belongsTo(PurchaseOrderItem::class);
    }
}
