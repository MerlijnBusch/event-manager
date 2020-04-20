<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('read', Event::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Event $event
     * @return void
     * @throws AuthorizationException
     */
    public function show(Event $event)
    {
        $this->authorize('read', Event::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('write', Event::class);

        return response()->json('test');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return void
     * @throws AuthorizationException
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('write', Event::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Event $event)
    {
        $this->authorize('write', Event::class);
    }
}
