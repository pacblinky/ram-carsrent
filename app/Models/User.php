<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Notifications\EmailVerificationCode;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
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
        'email',
        'password',
        'phone_number',
        "government_id",
        'is_admin',
        'verification_code',
        'verification_code_expires_at'
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
            'is_admin' => 'boolean',
            'verification_code_expires_at' => 'datetime'
        ];
    }

    /**
     * Get the URL to the user's profile photo.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin;
    }

    public function sendEmailVerificationNotification()
    {
        $this->generateVerificationCode();
        $this->notify(new EmailVerificationCode($this->verification_code));
    }

    public function generateVerificationCode()
    {
        $this->verification_code = rand(100000, 999999);
        $this->verification_code_expires_at = now()->addMinutes(15);
        $this->save();
    }

    public function verifyCode($code)
    {
        if ($this->verification_code === $code && $this->verification_code_expires_at->isFuture()) {
            $this->verification_code = null;
            $this->verification_code_expires_at = null;
            $this->markEmailAsVerified();
            return true;
        }
        return false;
    }
}