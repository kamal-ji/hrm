<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designations';

    protected $fillable = [
        'business_id',
        'department_id',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationships
     */

    // Designation belongs to a Business
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    // Designation belongs to a Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}