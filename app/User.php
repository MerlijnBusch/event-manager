<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string name
 * @property string email
 * @property string password
 * @property mixed email_verified_at
 * @property int role_id
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','role_id','email_verified_at', 'api_token_expired_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){

        return $this->hasOne('App\Profile', 'user_id');

    }

    public function role(){

        return $this->belongsTo('App\Role');

    }

    public function generateToken()
    {
        $this->api_token = Hash::make(Str::random(120), [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
        $this->api_token_expired_date = Carbon::now()->addHour();
        $this->save();

        return $this->api_token;
    }
}
