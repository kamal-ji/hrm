<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Table name
    protected $table = 'staff';

    // Fillable fields (for mass assignment)
    protected $fillable = [
        'business_id',
        'user_id',
        'employee_identifier',
        'job_title',
        'salary_type',
        'base_salary',
        'joining_date',
        'is_active',
    ];

    // Casts
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'user_id' => 'integer',
        'base_salary' => 'decimal:2',
        'joining_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relations
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}