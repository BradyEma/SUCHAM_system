<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierInventory extends Model
{
    protected $table = 'supplier_inventories';

    protected $fillable = [
        'product',
        'product_id',
        'unit_price',
        'measurement',
        'status',
        'actions',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
