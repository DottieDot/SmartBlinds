<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;

class UserController extends Controller {
    public function GetUser() {
        $user = User::find(Auth::id());

        return new UserResource($user);
    }
}
