<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read', Item::class);

        return response()->json(Item::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('write', Item::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'required|min:10',
            'event_id' => 'required|max:255',
            'date' => 'required|date',
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
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $this->authorize('read', Event::class);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->authorize('write', Item::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'required|min:10',
            'event_id' => 'required|max:255',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $event = Item::findOrFail($event->id);
        $event->update($request->all());

        return response()->json(['message' => 'Item ' . $item->name . ' updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
