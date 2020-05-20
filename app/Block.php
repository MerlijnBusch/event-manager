<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'date_start',
        'date_end',
    ];

    public function items(){

        return $this->hasMany('App\Item');

    }

    public function program(){

        return $this->belongsTo('App\Program');

    }


    public function delete()
    {
        $this->items()->delete();
        return parent::delete();
    }
}
