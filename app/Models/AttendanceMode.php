<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceMode extends Model
{
    use HasFactory;
    protected $table = 'attendance_modes';

     /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['model_name','is_active'];
protected $casts = ['is_active'=>'boolean'];

    
}
?>