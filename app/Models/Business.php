<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'owner_id',

        'business_name',
        'business_type',
        'industry_type',
        'business_category',

        'number_of_employees',

        'alternate_mobile',
        'designation',

        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'pincode',
        'country',

        'gst_number',
        'pan_number',
        'business_registration_number',

        'subscription_plan',
        'billing_cycle',

        'payment_method',
        'invoice_email',

        'salary_cycle',
        'salary_payment_date',
        'working_days_per_month',
        'default_shift_time',

        'sms_notifications',
        'whatsapp_alerts',
        'email_alerts',

        'max_employees_allowed',
        'current_employees',

        'upgrade_plan_option',

        'allow_upi',
        'allow_card',
        'allow_netbanking',
        'allow_wallet',
        'allow_razorpay',
        'allow_cashfree',
        'allow_phonepe_pg'
    ];

    protected $casts = [
        'sms_notifications' => 'boolean',
        'whatsapp_alerts' => 'boolean',
        'email_alerts' => 'boolean',

        'allow_upi' => 'boolean',
        'allow_card' => 'boolean',
        'allow_netbanking' => 'boolean',
        'allow_wallet' => 'boolean',
        'allow_razorpay' => 'boolean',
        'allow_cashfree' => 'boolean',
        'allow_phonepe_pg' => 'boolean',

        'upgrade_plan_option' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
