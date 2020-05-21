<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

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
    public function getAllItemTypes() {
        try {
            $reflectionClass = new ReflectionClass($this);
            return $reflectionClass->getConstants();
        } catch (\ReflectionException $e) {
            abort(500, "Internal Server Error");
        }
    }

    public const __CONGRESS__ = 'congress_program';
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
