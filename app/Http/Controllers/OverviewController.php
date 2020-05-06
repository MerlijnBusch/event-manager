<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    public function index(Event $event)
    {

        return response()->json( Event::query()->whereHas('settings', function($q) use($event){
            $q->where('active', true)->where('event_id', $event->id);
        })->whereHas('map', function($q) use($event){
            $q->where('active', true)->where('event_id', $event->id);
        })->whereHas('item', function($q) use($event){
        $q->where('active', true)->where('event_id', $event->id);
        })->get());
    }

}
