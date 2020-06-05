<?php

namespace App\Http\Controllers;

use App\Congress;
use App\Rules\EventExistValidator;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('write', Congress::class);

        $validator = Validator::make($request->all(), [
            'event_id' => ['required', new EventExistValidator],
            'name' => ['string'],
            'description' => ['string'],
            'active' => ['boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
