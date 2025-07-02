<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierInventory extends Model
{
    protected $table = 'supplier_inventories';

    protected $fillable = [
        'supplier_id',
        'product_name',
        'quantity',
        'unit',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'user_id');
    }
}
