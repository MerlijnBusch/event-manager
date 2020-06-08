<?php

namespace App\Http\Controllers;

use App\Block;
use App\Http\Requests\BlockStoreValidationRequest;
use App\Http\Requests\BlockUpdateValidationRequest;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BlockController extends Controller
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
     * @param Block $block
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Block $block)
    {
        $this->authorize('read', Block::class);

        return response()->json($block, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlockStoreValidationRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(BlockStoreValidationRequest $request)
    {
        $this->authorize('write', Block::class);

        Block::create($request->all());

        return response()->json(['message' => 'Block created successfully'], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param BlockUpdateValidationRequest $request
     * @param Block $block
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(BlockUpdateValidationRequest $request, Block $block)
    {
        $this->authorize('write', Block::class);

        $block = Block::findOrFail($block->id);
        $block->update($request->all());

        return response()->json(['message' => 'Block created successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Block $block
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Block $block)
    {
        $this->authorize('write', Block::class);

        $block->delete();

        return response()->json(['message' => 'Block deleted successfully'], 200);
    }
}
