<?php

namespace App\Http\Controllers;

use App\Item;
use App\Rules\EventExistValidator;
use App\Rules\ItemTypeValidator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('read', Item::class);

        return response()->json(Item::all());
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
        $this->authorize('write', Item::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'type' => ['required', 'max:255', new ItemTypeValidator],
            'description' => ['required', 'min:10'],
            'event_id' => ['required', new EventExistValidator],
            'date' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Item::create($request->all());

        return response()->json(['message' => 'Item created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Item $item)
    {
        $this->authorize('read', Item::class);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Item $item)
    {
        $this->authorize('write', Item::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'type' => ['required', 'max:255', new ItemTypeValidator],
            'description' => ['required', 'min:10'],
            'event_id' => ['required', new EventExistValidator],
            'date' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $item = Item::findOrFail($item->id);
        $item->update($request->all());

        return response()->json(['message' => 'Item ' . $item->name . ' updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Item $item)
    {
        $this->authorize('write', Item::class);

        $item = Item::findOrFail($item->id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
