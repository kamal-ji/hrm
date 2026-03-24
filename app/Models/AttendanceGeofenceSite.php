<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceGeofenceSite extends Model
{
    protected $table = 'attendance_geofence_sites';
    
    protected $fillable = [
        'attendance_geofence_id',
        'name',
        'address',
        'radius',
        'latitude',
        'longitude',
    ];
    
    public function attendanceGeofence()
    {
        return $this->belongsTo(AttendanceGeofence::class);
    }
}
