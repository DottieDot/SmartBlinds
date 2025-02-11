<?php

use App\RoutineAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::get('/routines', 'RoutineController@GetRoutines');
    Route::post('/routines', 'RoutineController@CreateRoutine');
    Route::middleware('owner:App\Routine,routine_id')->group(function() {
        Route::delete('/routines/{routine_id}', 'RoutineController@DeleteRoutine');
        Route::patch('/routines/{routine_id}/name', 'RoutineController@SetName');
        Route::patch('/routines/{routine_id}/trigger', 'RoutineController@SetTrigger');
        Route::patch('/routines/{routine_id}/days', 'RoutineController@SetDays');

        Route::post('/routines/{routine_id}/actions', 'RoutineController@CreateAction');
    });

    Route::middleware('owner:App\RoutineAction,action_id')->group(function() {
        Route::patch('/routines/actions/{action_id}/state', 'RoutineController@SetActionState');
        Route::delete('/routines/actions/{action_id}', 'RoutineController@DeleteAction');
    });

    Route::get('/homes', 'HomeController@GetHomes');
    Route::post('/homes', 'HomeController@CreateHome');
    Route::middleware('owner:App\Home,home_id')->group(function() {
        Route::delete('/homes/{home_id}', 'HomeController@DeleteHome');
        Route::patch('/homes/{home_id}/name', 'HomeController@SetHomeName');

        Route::post('/homes/{home_id}/rooms', 'RoomController@CreateRoom');
    });

    Route::middleware('owner:App\Room,room_id')->group(function() {
        Route::patch('/rooms/{room_id}/name', 'RoomController@SetRoomName');
        Route::patch('/rooms/{room_id}/state', 'RoomController@SetRoomState');
        route::delete('/rooms/{room_id}', 'RoomController@DeleteRoom');
    });

    Route::middleware('owner:App\System,system_id')->group(function() { 
        
    });

    Route::get('/user', 'UserController@GetUser');
    Route::patch('/user/details', 'UserController@ChangeDetails');
    Route::patch('/user/password', 'UserController@ChangePassword');

    Route::get('/systems', 'SystemController@GetSystems');
});

Route::get('/systems/{system_id}/state', 'SystemController@GetState');
