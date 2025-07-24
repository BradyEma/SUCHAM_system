<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversionLog extends Model
{
    protected $fillable = [
        'raw_material',
        'converted_product',
        'amount_used',
        'amount_produced',
        'converted_at'
    ];
}
