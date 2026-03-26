<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HolidayTemplateDate extends Model
{
    protected $fillable = [
        'holiday_template_id',
        'selected_date',
        'name',
    ];
    
    public function template()
    {
        return $this->belongsTo(HolidayTemplate::class);
    }
}
