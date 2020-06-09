<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramItemStoreValidationRequest;
use App\Http\Requests\ProgramItemUpdateValidationRequest;
use App\ProgramItems;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

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
     * @param ProgramItemStoreValidationRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(ProgramItemStoreValidationRequest $request)
    {
        $this->authorize('write', ProgramItems::class);

        ProgramItems::create($request->all());

        return response()->json(['message' => 'Item created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProgramItemUpdateValidationRequest $request
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(ProgramItemUpdateValidationRequest $request, $id)
    {
        $this->authorize('write', ProgramItems::class);

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
