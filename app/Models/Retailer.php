<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    use HasFactory;

    // ✅ Allow these fields to be mass-assigned
    protected $fillable = [
        'user_id',
        'business_name',
        'location',
        'contact_number',
        'tin',
        'status',
        'document_path',
    ];

    public function inventories()
    {
        return $this->hasMany(RetailerInventory::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}
