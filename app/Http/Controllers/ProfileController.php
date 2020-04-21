<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Profile;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read', Profile::class);

        return response()->json(Profile::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('write', Profile::class);

        //@todo merlijn custom validation image url en phone number
        $validator = Validator::make($request->all(), [
            'phone_number' => 'int',
            'image' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = new Profile;
        $profile->user_id = Auth::user()->id;
        $profile->phone_number = $request->phone_number;
        $profile->image = $request->image;
        $profile->save();

        return response()->json(['message' => 'Profile created succesfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $this->authorize('read', Profile::class);
        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('write', Profile::class);

        //@todo merlijn custom validation image url
        $validator = Validator::make($request->all(), [
            'phone_number' => 'int',
            'image' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = Profile::findOrFail($profile->id);
        $profile->user_id = Auth::user()->id;
        $profile->phone_number = $request->phone_number;
        $profile->image = $request->image;
        $profile->update();

        $name = $profile->user->name;

        return response()->json(['message' => 'Profile ' . $name . ' updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $this->authorize('write', Profile::class);

        $profile = Profile::findOrFail($profile->id);
        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecv(Request $request)
    {
        //@todo merlijn
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function showcv(Profile $profile)
    {
        //
    }
}
