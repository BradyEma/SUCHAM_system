<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsReceived extends Model
{
    // 🔧 Tell Laravel the correct table name
    protected $table = 'goods_received';

   protected $fillable = [
    'purchase_order_item_id',
    'quantity_received',
    'received_date',
    'delivered_at',
    'purchase_order_reference',
];


     public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function items()
    {
        return $this->hasMany(GoodsReceivedItem::class);
    }

    public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

}
