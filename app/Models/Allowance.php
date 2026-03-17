<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $table = 'allowances';

    protected $fillable = [
        'business_id',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationships
     */

    // Department belongs to a Business
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
