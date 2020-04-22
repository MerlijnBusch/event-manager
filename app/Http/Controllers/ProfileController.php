<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Rules\HtmlValidator;
use App\Rules\PhoneNumberValidator;
use App\Rules\UrlValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('read', Profile::class);

        $profiles = Profile::with('user')->get();

        return response()->json($profiles, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Profile $profile)
    {
        $this->authorize('read', Profile::class);

        $profile = Profile::findOrFail($profile->id)->with('user')->get();

        return response()->json($profile, 200);
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
        $this->authorize('write', Profile::class);

        if (Profile::where('user_id', '=', Auth::id())->count() > 0) {
            return response()->json(['message' => 'Profile already exist on this user']);
        }

        $validator = Validator::make($request->all(), [
            'phone_number' => ['string',new PhoneNumberValidator, 'required_without_all:image'],
            'image' => ['string',new UrlValidator, 'required_without_all:phone_number'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = new Profile;
        $profile->user_id = Auth::id();
        $profile->phone_number = $request->phone_number;
        $profile->image = $request->image;
        $profile->save();

        return response()->json(['message' => 'Profile created succesfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profile $profile
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('write', Profile::class);

        $validator = Validator::make($request->all(), [
            'phone_number' => [new PhoneNumberValidator, 'required_without_all:image'],
            'image' => ['string',new UrlValidator, 'required_without_all:phone_number'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = Profile::findOrFail($profile->id);
        $profile->user_id = Auth::id();
        $profile->phone_number = $request->phone_number;
        $profile->image = $request->image;
        $profile->update();

        $name = $profile->user->name;

        return response()->json(['message' => 'Profile ' . $name . ' updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Profile $profile)
    {
        $this->authorize('write', Profile::class);

        $profile = Profile::findOrFail($profile->id);
        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function showcv(Profile $profile)
    {
        $this->authorize('read', Profile::class);
        $this->authorize('readCV', Profile::class);

        $cv = Profile::findOrFail($profile->id)->pluck('cv');

        return response()->json($cv, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function storecv(Request $request)
    {
        $this->authorize('write', Profile::class);
        $this->authorize('writeCV', Profile::class);

        $validator = Validator::make($request->all(), [
            'cv' => [new HtmlValidator, 'required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = new Profile;
        $profile->user_id = Auth::id();
        $profile->cv = $request->cv;
        $profile->save();

        return response()->json(['message' => 'Profile cv created successfully'], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updatecv(Request $request, Profile $profile)
    {
        $this->authorize('write', Profile::class);
        $this->authorize('writeCV', Profile::class);
    
        $validator = Validator::make($request->all(), [
            'cv' => [new HtmlValidator, 'required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = Profile::findOrFail($profile->id);
        $profile->user_id = Auth::id();
        $profile->cv = $request->cv;
        $profile->update();

        return response()->json(['message' => 'CV updated successfully'], 200);
    }
}
