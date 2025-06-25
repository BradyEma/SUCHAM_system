<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function approvals()
    {
        return $this->hasMany(SupplierApproval::class);
    }

    protected $fillable = [
        'name',
        'email',
        'pdf_path',
        'verification_status',
    ];
}
