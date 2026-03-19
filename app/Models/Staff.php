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
        'gender',
        'date_of_birth',
        'marital_status',
        'blood_group',
        'emergency_contact',
        'father_name',
        'mother_name',
        'spouse_name',
        'physically_challenged',
        'current_address',
        'permanent_address',

        'department_id',
        'designation_id',
        'salary_type',
        'salary_cycle',
        'staff_type',
        'base_salary',
        'opening_balance_type',
        'opening_balance',
        'salary_details_access',
        'joining_date',

        'uan_number',
        'pan_number',
        'aadhaar_number',
        'bank_name',
        'bank_ifsc_code',
        'bank_ac_holder',
        'bank_ac_number',
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

        'current_address' => 'array',
        'permanent_address' => 'array',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contributions()
    {
        return $this->hasMany(StaffContribution::class);
    }
    
    public function earnings()
    {
        return $this->hasMany(StaffEarning::class);
    }

    public function deductions()
    {
        return $this->hasMany(StaffDeduction::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }


}
