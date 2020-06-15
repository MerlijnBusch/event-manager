<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationEvents extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'item_ids'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'event_id' => 'integer',
    ];

    public function user(){

        return $this->belongsTo('App\User');

    }

    public function event(){

        return $this->belongsTo('App\Event');

    }
}
