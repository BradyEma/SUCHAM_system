<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerWholesalerOrderItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'retailer_wholesaler_order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'retailer_wholesaler_order_id',
        'name',
        'price',
        'quantity',
        'unit'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'decimal:3',
    ];

    /**
     * Get the order that owns this item.
     */
    public function order()
    {
        return $this->belongsTo(RetailerWholesalerOrder::class, 'retailer_wholesaler_order_id');
    }

    /**
     * Calculate the total price for this item.
     */
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return 'Ugshs '.number_format($this->price, 2);
    }

    /**
     * Get the formatted total.
     */
    public function getFormattedTotalAttribute()
    {
        return 'Ugshs '.number_format($this->total, 2);
    }
}