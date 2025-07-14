<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
     protected $fillable = [
        'supplier_id', 
        'requested_by', 
        'order_date',
         'status'
        ];

        public function procurementRequest() {
    return $this->belongsTo(ProcurementRequest::class);
}

public function items() {
    return $this->hasMany(PurchaseOrderItem::class);
}

}
