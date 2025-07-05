<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorValidation extends Model
{
    protected $fillable = [
    'brn',
    'annual_revenue',
    'net_profit_margin',
    'years_of_operation',
    'customer_rating',
    'tax_clearance',
    'background_check',
    'financial_stability',
    'reputation',
    'regulatory_compliance',
];

}
