<?php

namespace App\Http\Controllers;

use App\Home;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function CreateRoom(Request $request, $home_id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $home = Home::find($home_id);
        $room = new Room([
            'name' => $validated['name'],
            'state' => 0,
        ]);
        $home->rooms()->save($room);

        return response()->json([
            'id' => $room->id,
        ]);
    }

    public function DeleteRoom($room_id) {
        $room = Room::find($room_id);
        $room->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function SetRoomState(Request $request, $room_id) {
        $validated = $request->validate([
            'state' => 'required|numeric|min:0|max:1'
        ]);

        $room = Room::find($room_id);
        $room->state = $validated['state'];
        $room->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function SetRoomName(Request $request, $room_id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $room = Room::find($room_id);
        $room->name = $validated['name'];
        $room->save();

        return response()->json([
            'success' => true,
        ]);
    }
}
