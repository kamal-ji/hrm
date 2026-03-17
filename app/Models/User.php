<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Impersonate;

    protected $fillable = [
        'role_id',
        'user_id',
        'member_id',
        'employee_id',
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'image',
        'mobile',
        'address1',
        'address2',
        'city',
        'zip',
        'countryid',
        'regionid',
        'dob',
        'anniversary',
        'status',
        'registration_type',
        'approved_by',
        'approved_at',
        'created_by_admin',
        'referral_code',
        'parent_id',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'string',
        ];
    }

    public function scopeStatus($query, $status = 'active')
    {
        return $query->where('status', $status);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryid');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'regionid');
    }

    public function business()
    {
        return $this->hasOne(Business::class, 'owner_id');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'user_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    public function getProfileImageAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('assets/backend/img/profiles/avatar-01.jpg');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function generateMemberId()
    {
        $prefix = 'MEM';
        $lastMember = self::role('member')->orderBy('id', 'desc')->first();

        $nextNumber = $lastMember ? intval(substr($lastMember->member_id, 3)) + 1 : 1;
        return $prefix . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public static function generateReferralCode()
    {
        $prefix = 'BHU';

        do {
            $code = $prefix . strtoupper(Str::random(6));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    public static function generateemployeeId()
    {
        $prefix = 'EMP';
        $lastEmployee = self::role('employee')->orderBy('id', 'desc')->first();

        $nextNumber = $lastEmployee ? intval(substr($lastEmployee->employee_id, 3)) + 1 : 1;
        return $prefix . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public function getParentId(){
        return $this->parent_id ?? $this->id;
    }

    public function getParentBusiness(){
        if($this->business){
            return $this->business;
        } else {
            return static::find($this->getParentId())->business;
        }
    }
}
