<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function GetUser() {
        $user = User::find(Auth::id());

        return new UserResource($user);
    }

    public function ChangeDetails(Request $request) {
        $validated = $request->validate([
            'name'  => 'string|required|max:255',
            'email' => [
                'email',
                'max:255',
                'required',
                Rule::unique('users')->ignore(Auth::id())
            ]
        ]);
        
        $user = User::find(Auth::id());
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function ChangePassword(Request $request) {
        $validated = $request->validate([
            'password' => 'required|string|max:70'
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($validated['password']);
        $user->save();

        return response()->json([
            'success' => true
        ]);
    }
}
