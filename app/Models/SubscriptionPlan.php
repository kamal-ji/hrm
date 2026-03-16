<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'status',
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
