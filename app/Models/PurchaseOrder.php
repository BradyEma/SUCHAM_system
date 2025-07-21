<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
     protected $fillable = [
        'po_number',
        'supplier_id', 
        'requested_by', 
        'order_date',
        'delivery_date',
        'total_amount',
         'status',
         'notes',
        ];

        public function procurementRequest() {
    return $this->belongsTo(ProcurementRequest::class);
}

public function items() {
    return $this->hasMany(PurchaseOrderItem::class);
}

public function goodsReceived() {
    return $this->hasOne(GoodsReceived::class);
}

 public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
