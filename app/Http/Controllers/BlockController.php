<?php

namespace App\Http\Controllers;

use App\Block;
use App\Rules\CongressExistValidator;
use App\Rules\ProgramExistValidator;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('write', Block::class);

        $validator = Validator::make($request->all(), [
            'congress_id' => ['required', new CongressExistValidator],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Block::create($request->all());

        return response()->json(['message' => 'Block created successfully'], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Block $block
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Block $block)
    {
        $this->authorize('write', Block::class);

        $validator = Validator::make($request->all(), [
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
