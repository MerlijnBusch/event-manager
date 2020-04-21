<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public const __CONGRESS_SPEAKERS__ = 'congress_speakers';
    public const __KEYNOTES__ = 'keynotes';

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
        'date',
        'active',
    ];

    public function event(){

        return $this->belongsTo('App\Event');

    }
}
