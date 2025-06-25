<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierApproval extends Model
{
    protected $fillable = ['supplier_id', 'user_id', 'action', 'note'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

