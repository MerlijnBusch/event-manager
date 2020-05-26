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

        $s = Event::query()
            ->with('program')
            ->with('settings')
            ->with('program.block')
            ->with('program.block.items')
            ->get();

        return response()->json($s, 200);
    }

    /**
     * @param Event $event
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function event(Event $event)
    {
        $this->authorize('read', Event::class);
        $this->authorize('read', EventSettings::class);
        $this->authorize('read', Program::class);

        $eventSettings = EventSettings::query()->where('event_id', $event->id)->first();

        $programs = Program::query()
                ->where('event_id', $event->id)
                ->with('block')
                ->with('block.items')->get();


        return response()->json(["event" => $event, "settings" => $eventSettings, "programs" => $programs], 200);
    }

    public function excel(Request $request){

        //@todo handle excel also ask what kind of excel should be uploaded

    }

}
