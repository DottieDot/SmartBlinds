<?php

namespace App\Http\Controllers;

use App\Home;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Home as HomeResource;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function GetHomes() {
        $user = User::find(Auth::id());

        return HomeResource::collection($user->homes);
    }

    public function CreateHome(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);

        $user = User::find(Auth::id());

        $home = new Home([
            'name'  => $validated['name'],
            'rooms' => []
        ]);

        $user->homes()->save($home);

        return response()->json([
            'id' => $home->id
        ]);
    }
}
