<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class MobileUser extends Authenticatable
{
    use HasApiTokens,Notifiable,HasFactory;
    protected $table = "mobile_user";
    protected $fillable = [
        'name','email','email_verified_at','emailOtpCode','phone','phone_verified_at','phoneOtpCode','password',
        'address'
    ];
}
