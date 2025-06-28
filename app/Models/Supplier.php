<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Supplier extends Authenticatable
{
      protected $guard = 'supplier';

    protected $primaryKey = 'user_id'; // 👈 Important
    public $incrementing = false; // 👈 user_id is not auto-incrementing
    protected $keyType = 'int'; // 👈 Because user_id is an integer
    public $timestamps = true;

   protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'location',
        'telNo',
        'Tax_ID',
        'TIN',
        'document_path',
        'is_approved',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $hidden = ['password'];
}
