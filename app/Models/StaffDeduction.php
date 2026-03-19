<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffDeduction extends Model
{
    protected $fillable = [
        'staff_id',
        'deduction_id',
        'type',
        'fixed_amount',
        'variable_percentage'
    ];

    public function relations()
    {
        return $this->hasMany(StaffDeductionRelation::class);
    }
}
