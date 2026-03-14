<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use App\Models\BinaryTree;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'user_id',
        'member_id',
        'employee_id',
        'name',
        'email',
        'password',
        'first_name',        // Added
        'last_name',         // Added
        'image',             // Added
        'mobile',            // Added
        'address1',          // Added
        'address2',          // Added
        'city',              // Added
        'zip', 
        'countryid',              // Added
        'regionid',          // Added
        'dob',               // Added
        'anniversary',       // Added
        'status',
        'registration_type',
        'approved_by',
        'approved_at',
        'created_by_admin',
        'referral_code',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'string',
        ];
    }

     // Scopes for easy filtering
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryid');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'regionid');
    }
    public function getProfileImageAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('assets/backend/img/profiles/avatar-01.jpg');
    }

    // Relationships
       
    

     // Get active sponsors only (for dropdown)
    public function scopeActiveSponsors($query)
    {
        return $query->role('member')
            ->where('status', 'active')
            ->whereNotNull('approved_at');
    }
   // Get full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    // Get sponsor info
    public function getSponsorInfoAttribute()
    {
        if ($this->sponsor) {
            return $this->sponsor->full_name . ' (' . $this->sponsor->member_id . ')';
        }
        return 'No Sponsor';
    }

    // Generate member ID (optional but useful for MLM)
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

}
