<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Home as HomeResource;

class HomeController extends Controller {
    public function GetHomes() {
        $user = User::find(Auth::id());

        return HomeResource::collection($user->homes);
    }
}
