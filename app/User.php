<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\VerifyApiEmail;
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
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role_id', 'email_verified_at', 'api_token_expired_date', 'updated_at', 'created_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_id' => 'integer',
    ];

    public function profile()
    {

        return $this->hasOne('App\Profile', 'user_id');

    }

    public function role()
    {

        return $this->belongsTo('App\Role');

    }

    /**
     * @return mixed|string
     */
    public function generateToken()
    {
        $this->api_token = Str::random(120);
        $this->api_token_expired_date = Carbon::now()->addHour();
        $this->save();

        return $this->api_token;
    }

    /**
     * @param $email
     * @return string
     */
    public function generateVerificationToken($email)
    {
        $token = Str::random(120);
        $q = DB::table('verify_token')->where('email', $email)->first();
        if($q == NULL){
             DB::table('verify_token')->insert([
            'email' => $email,
            'token' => $token,
            'date' => Carbon::now()
            ]);
        }else{
            DB::table('verify_token')->where('email', $email)->update(['token' => $token, 'date' => Carbon::now()]);
        }

        return $token;
    }

    /**
     * send password reset notification
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }

    /**
     * Send new email Verification
     */
    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmail);
    }
}
