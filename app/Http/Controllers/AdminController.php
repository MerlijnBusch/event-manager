<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSettings;
use App\Item;
use App\Permissions;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(!$this->isAdmin(Auth::user())){
            return response()->json('Unauthorized', 403);
        }

        return response()->json(Event::query()->get());
    }

    public function event(Event $event){
        if(!$this->isAdmin(Auth::user())){
            return response()->json('Unauthorized', 403);
        }

        $eventSettings = EventSettings::query()->where('event_id', $event->id)->get();
        $programs = Program::query()->where('event_id', $event->id)->get();
        $items = [];
        foreach ($programs as $p){
            $s = Item::query()->where('program_id', $p->id)->get();
            array_push($items, $s);
        }

        return response()->json([$event, $eventSettings, $programs, $items], 200);
    }

    protected function isAdmin($user){
        return in_array(Permissions::__ADMIN__, json_decode($user->role->permissions, 1));
    }
}
