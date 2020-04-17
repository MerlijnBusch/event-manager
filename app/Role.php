<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string role_name
 * @property string color
 * @property array permissions
 */

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name',
        'color',
        'permissions',
    ];

    public function user(){

        return $this->hasOne('App\User', 'role_id');

    }
}
