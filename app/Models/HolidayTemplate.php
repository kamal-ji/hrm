<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HolidayTemplate extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'selected_year',
    ];
    
    public function dates()
    {
        return $this->hasMany(HolidayTemplateDate::class);
    }
}
