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


    public function programItems(){

        return $this->hasMany('App\ProgramItems', 'program_id');

    }

    public function event(){

        return $this->belongsTo('App\Event');

    }

    public function delete()
    {
        $this->programItems()->delete();
        return parent::delete();
    }
}
