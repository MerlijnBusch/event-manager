<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed settings
 * @property mixed item
 * @property mixed map
 * @property mixed id
 * @property mixed|string name
 * @property mixed|string description
 * @property Carbon|mixed date_start
 * @property Carbon|mixed date_end
 * @property boolean active
 */
class Event extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date_start',
        'date_end',
        'active',
    ];

    public function map(){

        return $this->hasMany('App\Map', 'event_id');

    }

    public function settings(){

        return $this->hasOne('App\EventSettings', 'event_id');

    }

    public function program(){

        return $this->hasMany('App\Program', 'event_id');

    }
}
