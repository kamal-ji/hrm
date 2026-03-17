<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'business_id',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationships
     */

    // Department belongs to a Business
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    // Department has many Designations
    public function designations()
    {
        return $this->hasMany(Designation::class);
    }
}
