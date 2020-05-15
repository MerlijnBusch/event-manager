<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string name
 * @property mixed|string type
 * @property mixed|string description
 * @property Carbon|CarbonInterface|mixed date_start
 * @property Carbon|CarbonInterface|mixed date_end
 * @property HigherOrderBuilderProxy|mixed event_id
 * @property bool|mixed active
 */
class Program extends Model
{
    public const __CONGRESS_SPEAKERS__ = 'congress_speakers';
    public const __PROGRAM__ = 'program';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'event_id',
        'date_start',
        'date_end',
        'active',
    ];

    public function items(){

        return $this->hasMany('App\Item');

    }

    public function event(){

        return $this->belongsTo('App\Event');

    }
}
