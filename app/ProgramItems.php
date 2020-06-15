<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramItems extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'date',
        'program_id',
        'active',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    protected $casts = [
        'program_id' => 'integer',
        'active' => 'boolean',
    ];

    public function program(){

        return $this->belongsTo('App\Program');

    }
}
