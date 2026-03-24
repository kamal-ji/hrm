<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RotationalShift extends Model
{
    protected $table = 'shift_template_rotation_shifts';
    
    protected $fillable = [
        'shift_template_id',
        'name',
        'start_time',
        'end_time',
        'hour_minute',
    ];
    
    public function shiftTemplate()
    {
        return $this->belongsTo(ShiftTemplate::class);
    }
}
