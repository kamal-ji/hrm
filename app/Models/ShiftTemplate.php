<?php

namespace App\Models;

use App\Models\FixedBreak;
use App\Models\RotationalShift;
use Illuminate\Database\Eloquent\Model;

class ShiftTemplate extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'shift_type',
    ];
    
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function fixedBreaks(){
        return $this->hasMany(FixedBreak::class, 'shift_template_id');
    }

    public function rotationalShifts(){
        return $this->hasMany(RotationalShift::class, 'shift_template_id');
    }
}
