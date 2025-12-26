<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
    ];

    // generate OTP
    public function generateOtp(int $length = 6)
    {
        $otp = str_pad(random_int(0, (int) str_repeat('9', $length)), $length, '0', STR_PAD_LEFT);
        $this->otp = $otp;
        $this->otp_expires_at = now()->addMinutes(10);
        $this->save();
        return $otp;
    }

    // clear OTP
    public function clearOtp()
    {
        $this->otp = null;
        $this->otp_expires_at = null;
        $this->save();
    }

    public function cart()
    {
        return $this->hasOne(\App\Models\User\Cart::class);
    }

    public function wishList()
    {
        return $this->hasOne(\App\Models\User\WishList::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\User\Order::class);
    }

    public function transactions()
    {
        return $this->hasMany(\App\Models\User\Transaction::class);
    }
}
