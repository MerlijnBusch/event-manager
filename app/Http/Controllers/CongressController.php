<?php

namespace App\Http\Controllers;

use App\Congress;
use App\Http\Requests\CongressStoreValidationRequest;
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
     * Display the specified resource.
     *
     * @param Congress $congress
     * @return Response
     */
    public function show(Congress $congress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Congress $congress
     * @return Response
     */
    public function edit(Congress $congress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Congress $congress
     * @return Response
     */
    public function update(Request $request, Congress $congress)
    {
        //
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
