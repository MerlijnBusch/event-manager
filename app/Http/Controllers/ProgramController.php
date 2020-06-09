<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramStoreValidationRequest;
use App\Http\Requests\ProgramUpdateValidationRequest;
use App\Program;
use App\Rules\EventExistValidator;
use App\Rules\ProgramTypeValidator;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProgramController extends Controller
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
     * @param Program $program
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Program $program)
    {
        $this->authorize('read', Program::class);

        return response()->json($program, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProgramStoreValidationRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(ProgramStoreValidationRequest $request)
    {
        $this->authorize('write', Program::class);

        Program::create($request->all());

        return response()->json(['message' => 'Program created successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProgramUpdateValidationRequest $request
     * @param Program $program
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(ProgramUpdateValidationRequest $request, Program $program)
    {
        $this->authorize('write', Program::class);

        $program = Program::findOrFail($program->id);
        $program->update($request->all());

        return response()->json(['message' => 'Program created successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Program $program
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Program $program)
    {
        $this->authorize('write', Program::class);

        $program->delete();

        return response()->json(['message' => 'Program deleted successfully'], 200);
    }
}
