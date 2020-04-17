<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date',
    ];

    public function map(){

        return $this->hasMany('App\Map', 'event_id');

    }

    public function registrationEvent(){

        return $this->hasOne('App\RegistrationEventsSettings', 'event_id');

    }

    public function item(){

        return $this->hasMany('App\Item', 'event_id');

    }
}
