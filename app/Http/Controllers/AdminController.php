<?php

namespace App\Http\Controllers;

use App\Congress;
use App\Event;
use App\EventSettings;
use App\Program;
use App\Role;
use App\User;
use Exception;
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
            ->with('settings')
            ->with('program')
            ->with('program.programItems')
            ->with('congress')
            ->with('congress.block')
            ->with('congress.block.items')
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
        $this->authorize('read', Congress::class);

        $s = Event::query()
            ->where('id', $event->id)
            ->with('settings')
            ->with('program')
            ->with('program.programItems')
            ->with('congress')
            ->with('congress.block')
            ->with('congress.block.items')
            ->first();

        return response()->json($s, 200);
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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function search(Request $request)
    {
        $this->authorize('read', User::class);
        $this->authorize('read', Role::class);

        $validator = Validator::make($request->all(), [
            'search' => ['string']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::query()
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->with('role')
            ->get();

        return response()->json(['message' => $user], 200);
    }

    /**
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function deleteUser(User $user){
        $this->authorize('write', User::class);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    /**
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function user(User $user){
        $this->authorize('write', User::class);

        $user->makeVisible(['role_id']);

        return response()->json($user, 200);
    }
}
