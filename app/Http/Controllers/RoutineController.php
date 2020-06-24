<?php

namespace App\Http\Controllers;

use App\Http\Resources\Routine as RoutineResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    public function GetRoutines()
    {
        $user = User::find(Auth::id());

        return RoutineResource::collection($user->routines);
    }
}
