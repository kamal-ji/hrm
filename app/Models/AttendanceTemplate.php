<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceTemplate extends Model
{
    protected $table = 'attendance_templates';
    
    protected $fillable = [
        'business_id',
        'name',
        'attendance_mode',
        'attendance_on_holiday',
        'track_in_out_time',
        'no_attendance_without_punch_out',
        'allow_multiple_punches',
        'enable_auto_approval',
        'attendance_items',
        'automation_items',
        'approval_days',
        'mark_absent_on_previous_days',
        'effective_working_hours',
    ];
    
    protected $casts = [
        'attendance_items' => 'array',
        'automation_items' => 'array',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
