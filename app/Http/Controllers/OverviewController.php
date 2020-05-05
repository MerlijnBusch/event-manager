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
        return response()->json( Event::query()->with('settings', 'map', 'item')->where('active', true)->get(), 200);
    }

}
