<?php

namespace App;

use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string name
 * @property mixed|string json
 * @property HigherOrderBuilderProxy|mixed event_id
 * @property bool|mixed active
 */
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
