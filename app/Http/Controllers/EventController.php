<?php

namespace App\Http\Controllers;

use App\Event;
use App\RegistrationEvents;
use App\Rules\EventExistValidator;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return response()->json(Event::all(), 200);
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

        return response()->json($event, 200);
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

        return response()->json(['message' => 'Event created successfully'], 200);
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

        return response()->json(['message' => 'Event ' . $event->name . ' updated successfully'], 200);
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

        $event = Event::findOrFail($event->id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully'], 200);
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return JsonResponse
     */
    public function subscribe(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => ['required', new EventExistValidator, 'integer'],
            'user_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (RegistrationEvents::query()
                ->where('user_id', Auth::id())
                ->where('event_id', $event->id)
                ->first() != null) {
            return response()->json(['message' => 'Already subscribed to this event'], 403);
        }

        if(RegistrationEvents::query()->where('event_id',$event->id)->count() >= $event->settings->max_registrations){
            return response()->json(['message' => 'Event is already full'], 403);
        }

        $subscribe = new RegistrationEvents;
        $subscribe->user_id = Auth::id();
        $subscribe->event_id = $event->id;
        $subscribe->save();

        return response()->json(['message' => 'successfully subscribed to the event'], 200);
    }

    /**
     * @param Event $event
     * @return JsonResponse
     * @throws Exception
     */
    public function unsubscribe(Event $event)
    {
        $subscription = RegistrationEvents::query()
            ->where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->first();

        if ($subscription == null) {
            return response()->json(['message' => 'User is not subscribed to this event'], 403);
        }

        $subscription->delete();

        return response()->json(['message' => 'successfully subscribed to the event'], 200);
    }
}
