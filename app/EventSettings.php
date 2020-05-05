<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSettings extends Model
{
    public const __VISIBLE_REGISTRATIONS__ = 180;
    public const __MAX_REGISTRATIONS__ = 200;

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

    protected $hidden = [
        'active'
    ];

    public function event(){

        return $this->belongsTo('App\Event');

    }
}
