<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesalerOrder extends Model
{
    use HasFactory;

    protected $table = 'wholesaler_orders';  // Assuming orders are stored in 'orders' table

    // Fillable fields (adjust as per your table columns)
    protected $fillable = [
        'wholesaler_id',
        'customer_id',
        'product_id',
        'quantity',
        'total',
        'status',
        'transaction_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The wholesaler who owns this order
     */
    public function wholesaler()
    {
        return $this->belongsTo(User::class, 'wholesaler_id'); // Assuming wholesaler is a user
    }

    /**
     * The customer who made the order
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id'); // Assuming customer is a user
    }

    /**
     * The product ordered
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    
    /**
     * The logistics associated with this order
     */
    public function logistics()
    {
        return $this->hasMany(Logistics::class, 'order_id');
    }
}
