<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Determine if the user must verify their email address.
     */
    public function mustVerifyEmail(): bool
    {
        return config('mail.verification.required', true) && !$this->hasVerifiedEmail();
    }

    /**
     * Determine if the user has verified their email address.
     */
    public function hasVerifiedEmail(): bool
    {
        // If email verification is disabled in config, consider all users as verified
        if (!config('mail.verification.required', true)) {
            return true;
        }
        
        return !is_null($this->email_verified_at);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
        ];
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get the profile URL for AdminLTE
     */
    public function adminlte_profile_url(): string
    {
        return route('admin.profile.show');
    }

    /**
     * Get the profile image URL for AdminLTE
     */
    public function adminlte_image(): string
    {
        return asset('vendor/adminlte/dist/img/user2-160x160.jpg');
    }

    /**
     * Get the full name for AdminLTE
     */
    public function adminlte_desc(): string
    {
        return $this->role === 'admin' ? 'Administrator' : 'User';
    }
}
