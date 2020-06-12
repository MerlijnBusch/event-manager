<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use App\HTTP\Requests\EmailValidationRequest;
use App\HTTP\Requests\VerifyUserIdForEmailVerificationRequest;

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
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function verify(VerifyUserIdForEmailVerificationRequest $request) {

        $userID = $request['id'];
        $user = User::findOrFail($userID);
        $date = Carbon::now();
        $user->email_verified_at = $date;
        $user->save();

        return response()->json('test', 200);
    }

    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
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
