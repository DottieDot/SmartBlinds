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

    public function DeleteHome($home_id) {
        Home::find($home_id)->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function SetHomeName(Request $request, $home_id) {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);

        $home = Home::find($home_id);
        $home->name = $validated['name'];
        $home->save();

        return response()->json([
            'success' => true
        ]);
    }
}
