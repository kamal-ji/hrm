<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveTemplate extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'selected_year',
        'leave_cycle',
        'status'
    ];
    
    public function categories()
    {
        return $this->hasMany(LeaveTemplateCategory::class);
    }

    public function leaves()
{
    return $this->hasMany(LeaveTemplateCategory::class, 'leave_template_id');
}
}
