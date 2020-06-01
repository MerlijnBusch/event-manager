<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string role_name
 * @property string color
 * @property string selectable
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
        'selectable'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function user(){

        return $this->hasMany('App\User', 'role_id');

    }
}
