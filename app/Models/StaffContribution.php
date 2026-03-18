<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffContribution extends Model
{
    protected $fillable = [
        'staff_id',
        'deduction_id',
        'amount'
    ];
}