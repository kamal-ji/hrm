<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomationRule extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'late_entry_deductions_1',
        'late_entry_deductions_2',
        'late_entry_deductions_3',
        'early_exit_deductions_1',
        'early_exit_deductions_2',
        'early_exit_deductions_3',
        'break_rules_1',
        'break_rules_2',
        'break_rules_3',
        'overtime_rules_1',
        'overtime_rules_2',
        'overtime_rules_3',
        'early_overtime_rules_1',
        'early_overtime_rules_2',
        'early_overtime_rules_3',
    ];
    
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    
    public function rules()
    {
        return $this->hasMany(AutomationRuleSet::class);
    }
}
