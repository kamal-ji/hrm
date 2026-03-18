<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffEarning extends Model
{
    protected $fillable = [
        'staff_id',
        'allowance_id',
        'amount'
    ];
}
