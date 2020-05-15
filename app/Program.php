<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public const __CONGRESS_SPEAKERS__ = 'congress_speakers';
    public const __PROGRAM__ = 'program';

    public function items(){

        return $this->hasMany('App\Item');

    }

    public function event(){

        return $this->belongsTo('App\Event');

    }
}
