<?php

namespace App\Http\Controllers;

use App\Congress;
use App\Http\Requests\CongressStoreValidationRequest;
use App\Http\Requests\CongressUpdateValidationRequest;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CongressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param Congress $congress
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Congress $congress)
    {
        $this->authorize('read', Congress::class);

        return response()->json($congress, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CongressStoreValidationRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CongressStoreValidationRequest $request)
    {
        $this->authorize('write', Congress::class);

        Congress::create($request->all());

        return response()->json(['message' => 'Congress created successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CongressUpdateValidationRequest $request
     * @param Congress $congress
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(CongressUpdateValidationRequest $request, Congress $congress)
    {
        $this->authorize('write', Congress::class);

        $congress = Congress::findOrFail($congress->id);
        $congress->update($request->all());

        return response()->json(['message' => 'Congress created successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Congress $congress
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Congress $congress)
    {
        $this->authorize('write', Congress::class);

        $congress->delete();

        return response()->json(['message' => 'Congress deleted successfully'], 200);
    }
}
