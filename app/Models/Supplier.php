<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Supplier extends Authenticatable
{
    protected $guard = 'supplier';

    protected $fillable = [
        'name',
        'business_name',
        'email',
        'raw_material',
        'tin_or_nin',
        'location',
        'verification_file',
        'password',
        'status',
        'role'
    ];

    protected $hidden = ['password'];
}
