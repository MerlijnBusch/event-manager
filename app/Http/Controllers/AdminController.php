<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSettings;
use App\Program;
use App\Role;
use App\Rules\RoleSelectableValidator;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @param Request $request
     * @return JsonResponse|string
     * @throws AuthorizationException
     */
    public function excel(Request $request){

        $this->authorize('write', User::class);

        $data = [ 'data' => $request->all() ];

        $validator = Validator::make($data, [
            'data.*.name' => ['required', 'string'],
            'data.*.email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'data.*.role' => ['required', 'string'],
            'data.*.password' => ['required', 'string', 'min:8']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        foreach ($data["data"] as $obj){

            $role = Role::query()->where('role_name', $obj["role"])->first();

            if($role == null) {
                return response()->json('Role not found', 200);
            }

            $user = new User;
            $user->name = $obj->name;
            $user->email = $obj->email;
            $user->password = $obj->password;
            $user->role_id = $role->id;
        }

        return response()->json(['message' => 'Successfully uploaded the excel'], 200);
    }

}
