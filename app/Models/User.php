<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'profile_code',
        'reg_number',
        'printout',
        'email',
        'email_acessible', // Keep as 'acessible' as per migration, but consider renaming in migration if typo
        'phone',
        'phone_available',
        'sms_credit_bal_above_100',
        'new_password_received',
        'recovery_successful',
        'password',
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
    
            'password' => 'hashed',
             // 'email_verified_at' => 'datetime', // Uncomment if you have this in your User model
        'printout' => 'boolean',
        'email_acessible' => 'boolean',
        'phone_available' => 'boolean',
        'sms_credit_bal_above_100' => 'boolean',
        'new_password_received' => 'boolean',
        'recovery_successful' => 'boolean',
        'password' => 'hashed',
        ];
    }
}
