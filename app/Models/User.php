<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'email', 'password', 'confirmation_token', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function videos()
    {
        return $this->hasMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isConfirmed()
    {
        return !! $this->email_verified_at;
    }

    public function getEmailConfirmationToken()
    {
        $token = Str::random();
        $this->update([
            'confirmation_token' => $token,
        ]);

        return $token;
    }

    public function confirm()
    {
        $this->update([
            'email_verified_at' => Carbon::now(),
            'confirmation_token' => null
        ]);
    }

    
}
