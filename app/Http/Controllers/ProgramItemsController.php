<?php

namespace App\Http\Controllers;

use App\Program;
use App\ProgramItems;
use App\Rules\ProgramExistValidator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProgramItemsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('read', ProgramItems::class);

        $s = ProgramItems::findOrFail($id);

        return response()->json($s, 200);
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
        $this->authorize('write', ProgramItems::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'description' => ['required'],
            'program_id' => ['required', new ProgramExistValidator],
            'date' => ['date'],
            'active' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        ProgramItems::create($request->all());

        return response()->json(['message' => 'Item created successfully']);
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
        $this->authorize('write', ProgramItems::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'description' => ['required'],
            'program_id' => ['required', new ProgramExistValidator],
            'date' => ['date'],
            'active' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $item = ProgramItems::findOrFail($id);
        $item->update($request->all());

        return response()->json(['message' => 'Program Item ' . $item->name . ' updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('write', ProgramItems::class);

        $item = ProgramItems::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Program Item deleted successfully'], 200);
    }
}
