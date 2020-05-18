<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSettings;
use App\Item;
use App\Permissions;
use App\Program;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('read', Event::class);

        return response()->json(Event::query()->get());
    }

    /**
     * @param Event $event
     * @return JsonResponse
     */
    public function event(Event $event)
    {
        $eventSettings = [];
        $programs = [];

        if (Auth::user()->can('read', EventSettings::class)) {
            $eventSettings = EventSettings::query()->where('event_id', $event->id)->first();
        }

        if (Auth::user()->can('read', Program::class) && Auth::user()->can('read', Item::class)) {
            $programs = Program::query()->where('event_id', $event->id)->with('items')->get();
        }

        return response()->json(["event" => $event, "settings" => $eventSettings, "programs" => $programs], 200);
    }

}
