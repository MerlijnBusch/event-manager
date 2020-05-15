<?php

namespace App\Http\Controllers;

use App\Event;
use App\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(!$this->isAdmin(Auth::user())){
            return response()->json('Unauthorized', 403);
        }

        return response()->json(Event::query()->get());
    }

    protected function isAdmin($user){
        return in_array(Permissions::__ADMIN__, json_decode($user->role->permissions, 1));
    }
}
