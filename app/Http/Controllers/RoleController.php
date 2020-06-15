<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreValidationRequest;
use App\Http\Requests\RoleUpdateValidationRequest;
use App\Permissions;
use App\Role;
use App\Rules\ColorValidator;
use App\Rules\PermissionExistValidator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('read', Role::class);

        $roles = Role::query()->get();

        return response()->json($roles, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Role $role)
    {
        $this->authorize('read', Role::class);

        return response()->json($role, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleStoreValidationRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(RoleStoreValidationRequest $request)
    {
        $this->authorize('write', Role::class);

        $role = new Role;
        $role->role_name = $request->role_name;
        $role->color = $request->color;
        $role->permissions = json_encode($request->permissions);
        $role->save();

        return response()->json(['message' => 'Role created successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleUpdateValidationRequest $request
     * @param Role $role
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(RoleUpdateValidationRequest $request, Role $role)
    {
        $this->authorize('write', Role::class);

        $role = Role::findOrFail($role->id);
        $role->role_name = $request->role_name;
        $role->color = $request->color;
        $role->permissions = json_encode($request->permissions);
        $role->update();

        return response()->json(['message' => 'Role updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Role $role)
    {
        $this->authorize('write', Role::class);

        $role = Role::findOrFail($role->id);
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }

    /**
     * @return JsonResponse
     */
    public function showSelectables()
    {
        $roles = Role::query()
        ->where('selectable', 1)
        ->get(["id" ,"role_name"]);

        return response()->json($roles, 200);
    }

    /**
     * @param Role $role
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateSelectable(Role $role)
    {
        $this->authorize('write', Role::class);

        $updateRole = Role::findOrFail($role->id);
        $updateRole->selectable = !$role->selectable;
        $updateRole->update();

        return response()->json(['message' => 'Role updated successfully'], 200);
    }
}
