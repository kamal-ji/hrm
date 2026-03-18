<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'business_id',
        'user_id',
        'employee_identifier',
        'department_id',
        'designation_id',
        'job_title',
        'salary_type',
        'salary_cycle',
        'staff_type',
        'base_salary',
        'opening_balance_type',
        'opening_balance',
        'salary_details_access',
        'joining_date',
        'is_active',
    ];

    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'user_id' => 'integer',
        'department_id' => 'integer',
        'designation_id' => 'integer',
        'base_salary' => 'decimal:2',
        'opening_balance' => 'decimal:2',
        'salary_details_access' => 'boolean',
        'joining_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}