<?php

namespace App\Http\Controllers;

use App\Program;
use App\Rules\EventExistValidator;
use App\Rules\ProgramTypeValidator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
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
        $this->authorize('write', Program::class);

        $validator = Validator::make($request->all(), [
            'event_id' => ['string', new EventExistValidator],
            'name' => ['string'],
            'date_start' => ['string'],
            'date_end' => ['string'],
            'description' => ['string'],
            'type' => ['string', new ProgramTypeValidator],
            'active' => ['boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Program::create($request->all());

        return response()->json(['message' => 'Program created successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }
}
