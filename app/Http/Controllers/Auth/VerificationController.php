<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\DB;
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
      
    }


    /**
     * Mark the authenticated user’s email address as verified.
     *
     * @param VerifyUserIdForEmailVerificationRequest $request
     * @return JsonResponse
     */
    public function verify(VerifyUserIdForEmailVerificationRequest $request) {

        $userTokenMail = DB::table('verify_token')->where('token', $request->token)->first();
    
        if($userTokenMail == NULL){
            return response()->json('De activatielink is ongeldig .', 200);
        }

        $user = User::query()->where('email', $userTokenMail->email)->first();

        if($user == NULL){
           return response()->json('Geen geldige account gevonden, probeer opnieuw een activatielink op te sturen via het inlog systeem. ', 200);
        }
      
        $date = Carbon::now();
        $user->email_verified_at = $date;
        $user->update();

        //Deleting activation token after verifying
        DB::table('verify_token')->where('token', $request->token)->delete();

        return response()->json('Uw account is geactiveerd, u kunt nu inloggen en uw aanmelden voor evenementen.', 200);

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
