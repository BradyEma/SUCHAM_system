<?php

namespace App\Models;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Model;

class Logistics extends Model
{
    protected $casts = [
    'route_history' => 'array',
];

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_by',
        'current_location',
        'destination',
        'route_history',
        'latitude',
        'longitude',
        'estimated_arrival',
    ];


    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function order()
    {
        return $this->belongsTo(WholesalerOrder::class);
    }
}
