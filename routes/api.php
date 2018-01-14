<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function(){
    // Points API Routes without Token.
    Route::get('points', 'PointController@index');
    Route::get('points/{point}', 'PointController@show');
    
    // User Login API Routes without Token.
    Route::get('user/login', 'Auth\APILoginController@index');
    Route::get('user/auth', 'Auth\APILoginController@getAuthenticatedUser');
});