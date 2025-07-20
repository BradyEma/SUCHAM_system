<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSegment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customers_email',
        'order_amount',
        'order_count',
        'cluster',
        'label',
    ];
}
