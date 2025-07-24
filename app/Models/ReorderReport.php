<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReorderReport extends Model
{
    protected $fillable = [
        'material_name',
        'quantity_requested',
        'requested_by',
        'requested_at',
    ];

    protected $casts = [
    'requested_at' => 'datetime',
];
    // protected $dates = ['requested_at'];
}
