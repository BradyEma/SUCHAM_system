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

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
