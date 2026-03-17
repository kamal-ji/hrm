<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Table name
    protected $table = 'employees';

    // Fillable fields (for mass assignment)
    protected $fillable = [
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
        'user_id' => 'integer',
        'base_salary' => 'decimal:2',
        'joining_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}