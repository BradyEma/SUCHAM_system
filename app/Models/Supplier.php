<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Supplier extends Authenticatable
{
      protected $guard = 'supplier';

    protected $primaryKey = 'user_id'; 
    public $incrementing = false; 
    protected $keyType = 'int'; 
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
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $hidden = ['password'];
}
