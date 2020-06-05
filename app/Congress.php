<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Congress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'event_id',
        'active',
    ];


    public function block(){

        return $this->hasMany('App\Block');

    }

    public function event(){

        return $this->belongsTo('App\Event');

    }

    public function delete()
    {
        $this->block()->delete();
        return parent::delete();
    }
}
