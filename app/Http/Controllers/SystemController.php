<?php

namespace App\Http\Controllers;

use App\User;
use App\System;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\System as SystemResource;

class SystemController extends Controller
{
    public function GetSystems() {
        $user = User::find(Auth::id());

        return SystemResource::collection($user->systems);
    }  

    public function GetState($system_id) {
        $system = System::find($system_id);

        return response()->json([
            'state' => $system->room->state
        ]);
    }
}
