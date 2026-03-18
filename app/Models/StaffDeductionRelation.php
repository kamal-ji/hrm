<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffDeductionRelation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'staff_deduction_id',
        'allowance_id'
    ];
}