<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Supplier extends Authenticatable
{
    protected $guard = 'supplier';

   protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'location',
        'telNo',
        'Tax_ID',
        'TIN',
        'document_path',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $hidden = ['password'];
}
