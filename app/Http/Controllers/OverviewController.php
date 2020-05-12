<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSettings;
use App\Item;
use App\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    public function index(Event $event)
    {
        $eventSettings = EventSettings::query()->where('event_id', $event->id)->first();
        $eventMaps = Map::query()->where('event_id', $event->id)->get();
        $eventItems = Item::query()->where('event_id', $event->id)->get();
        return response()->json([$event, $eventSettings, $eventMaps, $eventItems], 200);
    }
}
