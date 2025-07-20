<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierInventory extends Model
{
    protected $table = 'supplier_inventories';

    // Tell Eloquent the primary key is product_id and it's auto-incrementing integer
    protected $primaryKey = 'product_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'product_name',
        'product_id',
        'quantity',
        'unit_price',
        'unit_of_measurement',
        'status',
        'actions',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'product_id';
    }
}