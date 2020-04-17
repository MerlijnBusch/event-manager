<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'json',
        'event_id',
        'active',
    ];

    public function event(){

        return $this->belongsTo('App\Event');

    }
}
