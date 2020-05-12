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
        'date',
    ];

    public function map(){

        return $this->hasMany('App\Map', 'event_id');

    }

    public function settings(){

        return $this->hasOne('App\EventSettings', 'event_id');

    }

    public function item(){

        return $this->hasMany('App\Item', 'event_id');

    }
}
