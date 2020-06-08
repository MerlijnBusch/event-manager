<?php

namespace App\Http\Controllers;

use App\EventSettings;
use App\Rules\ColorValidator;
use App\Rules\EventExistValidator;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Validator;

class EventSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('read', EventSettings::class);

        $settings = Event::with('settings')->get();

        return response()->json($settings, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('read', EventSettings::class);

        $settings = Event::findOrFail($id);

        return response()->json($settings, 200);
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
        $this->authorize('write', EventSettings::class);

        $validator = Validator::make($request->all(), [
            'event_id' => ['required', new EventExistValidator],
            'visible_registrations' => ['required', 'integer'],
            'max_registrations' => ['required', 'gt:visible_registrations', 'integer'],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
            'color' => ['required', new ColorValidator],
            'location' => ['required', 'string'],
            'light_theme' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (EventSettings::where('event_id', $request->event_id)->first() != null) {
            return response()->json(['message' => 'Event Settings already exist for this Event'], 403);
        }

        EventSettings::create($request->all());

        return response()->json(['message' => 'Event Settings created successfully'], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->authorize('write', EventSettings::class);

        $validator = Validator::make($request->all(), [
            'visible_registrations' => ['required', 'integer'],
            'max_registrations' => ['required', 'gt:visible_registrations', 'integer'],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
            'color' => ['required', new ColorValidator],
            'location' => ['required', 'string'],
            'light_theme' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return response()->json(['message' => 'Event Settings updated successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Event $event)
    {
        $this->authorize('write', EventSettings::class);

        $settings = EventSettings::query()->where('event_id', $event->id)->first();
        $settings->delete();

        return response()->json(['message' => 'Event Settings deleted successfully'], 200);
    }
}
