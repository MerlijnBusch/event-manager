<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property HigherOrderBuilderProxy|mixed event_id
 * @property int|mixed visible_registrations
 * @property int|mixed max_registrations
 * @property mixed|string secondary_color
 * @property mixed|string primary_color
 * @property bool|mixed active
 * @property Carbon|mixed date_start
 * @property Carbon|CarbonInterface|mixed date_end
 */
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
        'date_start',
        'date_end',
        'light_theme',
        'color'
    ];

    protected $hidden = [
        'updated_at', 'created_at','active','deleted_at'
    ];

    protected $casts = [
        'event_id' => 'integer',
        'visible_registrations' => 'integer',
        'max_registrations' => 'integer',
        'light_theme' => 'boolean',
    ];

    public function event(){

        return $this->belongsTo('App\Event');

    }
}
