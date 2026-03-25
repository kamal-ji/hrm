<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomationRuleSet extends Model
{
    protected $table = 'automation_rules_set';
    
    protected $fillable = [
        'automation_rule_id',
        'rule_type',
        'hour_minute',
        'type',
        'amount',
    ];
    
    public function automationRule()
    {
        return $this->belongsTo(AutomationRule::class);
    }
}
