<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('read', Event::class);

        return response()->json(Event::all());
    }

    /**
     * Display a listing of the resource.
     *
     * @param Event $event
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Event $event)
    {
        $this->authorize('read', Event::class);
        return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('write', Event::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|min:10',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Event::create($request->all());

        return response()->json(['message' => 'Event created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('write', Event::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|min:10',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $event = Event::findOrFail($event->id);
        $event->update($request->all());

        return response()->json(['message' => 'Event ' . $event->name . ' updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Event $event)
    {
        $this->authorize('write', Event::class);

        $event = Event::findOrFail($event);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
