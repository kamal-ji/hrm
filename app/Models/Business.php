<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Business extends Model
{
    protected $fillable = [
        'owner_id',
        'business_name',
        'business_type',
        'address',
        'city',
        'subscription_status',
    ];

    public function scopeSubscription($query, $status)
    {
        return $query->where('subscription_status', $status);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
