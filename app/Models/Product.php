<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'sku'; // Set primary key to SKU
    public $incrementing = false; // SKU is not auto-incrementing
    protected $keyType = 'string'; // SKU is a string, not an integer

    protected $fillable = ['sku', 'name', 'description'];
}
