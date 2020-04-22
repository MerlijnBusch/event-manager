<?php

namespace App\Http\Middleware;

use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class ApiTokenStillValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::find(Auth::id());
        if($user->api_token_expired_date < Carbon::now()){
            $user->api_token = null;
            $user->save();
            $this->response();
        }

        if($user->api_token == null){
            $this->response();
        }

        return $next($request);
    }

    private function response(){
        return response()->json(['message' => 'User is not Authorized anymore'], 403);
    }
}
