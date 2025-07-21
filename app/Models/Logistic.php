<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    protected $fillable = ['name', 'vehicle_no', 'route', 'status', 'created_by'];

}
