<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreValidationRequest;
use App\Http\Requests\ItemUpdateValidationRequest;
use App\Item;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

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
     * @param ItemStoreValidationRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(ItemStoreValidationRequest $request)
    {
        $this->authorize('write', Item::class);

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
     * @param ItemUpdateValidationRequest $request
     * @param Item $item
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(ItemUpdateValidationRequest $request, Item $item)
    {
        $this->authorize('write', Item::class);

        $item = Item::findOrFail($item->id);
        $item->update($request->all());

        return response()->json(['message' => 'Item ' . $item->name . ' updated successfully'], 200);
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
