<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedBreak extends Model
{
    protected $table = 'shift_template_fixed_breaks';
    
    protected $fillable = [
        'shift_template_id',
        'name',
        'pay_type',
        'type',
        'hour_minute',
        'interval_start',
        'interval_end',
    ];
    
    public function shiftTemplate()
    {
        return $this->belongsTo(ShiftTemplate::class);
    }
}
