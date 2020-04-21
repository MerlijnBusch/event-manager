<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationEventsSettings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'visible_registrations',
        'max_registrations',
        'active',
    ];

    public function event(){

        return $this->belongsTo('App\Event');

    }

}
