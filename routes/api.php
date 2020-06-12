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

    Route::middleware('owner:App\Home,home_id')->group(function() {
        Route::delete('/homes/{home_id}', 'HomeController@DeleteHome');
        Route::patch('/homes/{home_id}/name', 'HomeController@SetHomeName');
    });

    Route::get('/user', 'UserController@GetUser');

    Route::get('/systems', 'SystemController@GetSystems');
});