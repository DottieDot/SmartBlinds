<?php

namespace App\Http\Controllers;

use App\Http\Resources\Routine as RoutineResource;
use App\Room;
use App\Routine;
use App\RoutineAction;
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

    public function CreateRoutine(Request $request)
    {
        $user = User::find(Auth::id());
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $routine = new Routine([
            'name' => $validated['name'],
            'trigger_at' => '00:00:00',
            'days' => 0,
        ]);
        $user->routines()->save($routine);

        return response()->json([ 
            'id' => $routine->id,
        ]);
    }

    public function DeleteRoutine($routine_id)
    {
        Routine::find($routine_id)->delete();

        return response()->json([ 
            'success' => true
        ]);
    }

    public function SetName(Request $request, $routine_id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $routine = Routine::find($routine_id);
        $routine->name = $validated['name'];
        $routine->save();

        return response()->json([ 
            'success' => true
        ]);
    }

    public function SetTrigger(Request $request, $routine_id)
    {
        $validated = $request->validate([
            'trigger' => 'required|string'
        ]);

        $routine = Routine::find($routine_id);
        $routine->trigger_at = $validated['trigger'];
        $routine->save();

        return response()->json([ 
            'success' => true
        ]);
    }

    public function SetDays(Request $request, $routine_id) 
    {
        $validated = $request->validate([
            'days' => 'numeric|required'
        ]);

        $routine = Routine::find($routine_id);
        $routine->days = $validated['days'];
        $routine->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function CreateAction(Request $request, $routine_id)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id'
        ]);

        $room = Room::find($validated['room_id']);
        if ($room->user->id !== Auth::id()) {
            abort(403);
        }

        $action = new RoutineAction([
            'room_id' => $validated['room_id'],
            'state' => 0,
        ]);

        $routine = Routine::find($routine_id);
        $routine->actions()->save($action);

        return response()->json([
            'id' => $action->id,
        ]);
    }

    public function SetActionState(Request $request, $action_id) 
    {
        $validated = $request->validate([
            'state' => 'numeric|min:0|max:1'
        ]);
        
        $action = RoutineAction::find($action_id);
        $action->state = $validated['state'];
        $action->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function DeleteAction(Request $request, $action_id)
    {
        $action = RoutineAction::find($action_id);
        $action->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
