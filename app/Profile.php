<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone_number',
        'image',
        'cv',
    ];

    protected $hidden = [
        'updated_at', 'created_at',
    ];

    public function user(){

        return $this->belongsTo('App\User');

    }
}
