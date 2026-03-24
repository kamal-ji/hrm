<?php

namespace App\Models;

use App\Models\AttendanceGeofenceSite;
use Illuminate\Database\Eloquent\Model;

class AttendanceGeofence extends Model
{
    protected $table = 'attendance_geofences';
    
    protected $fillable = [
        'business_id',
        'name',
        'approval_required',
    ];
    
    protected $casts = [
        'approval_required' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    
    public function sites()
    {
        return $this->hasMany(AttendanceGeofenceSite::class);
    }
}
