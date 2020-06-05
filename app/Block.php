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
        'congress_id',
        'date_start',
        'date_end',
    ];

    protected $hidden = [
        'updated_at', 'created_at','deleted_at'
    ];

    public function items(){

        return $this->hasMany('App\Item');

    }

    public function congress(){

        return $this->belongsTo('App\Congress');

    }


    public function delete()
    {
        $this->items()->delete();
        return parent::delete();
    }
}
