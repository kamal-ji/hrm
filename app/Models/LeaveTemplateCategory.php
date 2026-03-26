<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveTemplateCategory extends Model
{
    protected $fillable = [
        'leave_template_id',
         'name',
        'leave_count',
        'leave_rule',
        'carry_forward_limit',
    ];
    
    public function template()
    {
        return $this->belongsTo(LeaveTemplate::class);
    }
}
