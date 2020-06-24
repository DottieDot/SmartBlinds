<?php

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
    Route::get('/homes', 'HomeController@GetHomes');
    Route::post('/homes', 'HomeController@CreateHome');

    Route::get('/routines', 'RoutineController@GetRoutines');

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
        Route::get('/systems/{system_id}/state', 'SystemController@GetState');
    });

    Route::get('/user', 'UserController@GetUser');
    Route::patch('/user/details', 'UserController@ChangeDetails');
    Route::patch('/user/password', 'UserController@ChangePassword');

    Route::get('/systems', 'SystemController@GetSystems');
});