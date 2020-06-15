<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\HTTP\Requests\EmailValidationRequest;
use App\HTTP\Requests\VerifyUserIdForEmailVerificationRequest;
use Illuminate\Http\Response;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    /**
     * Mark the authenticated user’s email address as verified.
     *
     * @param VerifyUserIdForEmailVerificationRequest $request
     * @return JsonResponse
     */
    public function verify(VerifyUserIdForEmailVerificationRequest $request) {

        $userTokenMail = DB::table('verify_token')->where('token', $request.token)->first();

        $user = User::query()->where('email', $userTokenMail->email)->first();
        $date = Carbon::now();
        $user->email_verified_at = $date;
        $user->update();

        return response()->json('test goed ', 200);
    }

    /**
     * Resend the email verification notification.
     *
     * @param EmailValidationRequest $request
     * @return JsonResponse
     */
    public function resend(EmailValidationRequest $request)
    {
        $user = User::query()->where('email', $request->email)->first();

        if ($user->email_verified_at != NULL) {

            return response()->json('User already have verified email!', 422);
            // return redirect($this->redirectPath());
        }
        $user->sendApiEmailVerificationNotification();
        return response()->json('The notification has been resubmitted', 200);
        // return back()->with(‘resent’, true);
    }



}
