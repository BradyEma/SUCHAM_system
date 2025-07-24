<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerWholesalerOrder extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'retailer_wholesaler_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'retailer_id',
        'wholesaler_id',
        'order_status',
        'total_amount',
        'order_date',
        'delivery_date',
        'delivery_address',
        'notes',
        'business_name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'order_status' => 'pending',
    ];

    /**
     * Get the retailer that placed the order.
     */
    public function retailer()
    {
        return $this->belongsTo(User::class, 'retailer_id');
    }

    /**
     * Get the wholesaler for the order.
     */
    public function wholesaler()
    {
        return $this->belongsTo(User::class, 'wholesaler_id');
    }

    /**
     * Get all items for the order.
     */
    public function items()
    {
        return $this->hasMany(RetailerWholesalerOrderItem::class, 'retailer_wholesaler_order_id');
    }

    /**
     * Scope a query to only include pending orders.
     */
    public function scopePending($query)
    {
        return $query->where('order_status', 'pending');
    }

    /**
     * Scope a query to only include completed orders.
     */
    public function scopeCompleted($query)
    {
        return $query->where('order_status', 'completed');
    }

    /**
     * Calculate the total amount with tax.
     */
    public function calculateTotalWithTax()
    {
        return $this->total_amount * 1.10; // Assuming 10% tax
    }

    /**
     * Get the order status with a badge.
     */
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        return '<span class="px-2 py-1 rounded-full text-xs font-medium '.$statuses[$this->order_status].'">'.
                ucfirst($this->order_status).
               '</span>';
    }
}