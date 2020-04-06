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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'API\AuthController@login');
Route::post('user/create', 'API\UserController@register');


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'API\AuthController@logout');
    Route::get('user', 'API\UserController@index');
    Route::get('user/{user}', 'API\UserController@show');
    Route::put('user/{user}', 'API\UserController@update');
    Route::put('user/{user}', 'API\UserController@update');
    Route::delete('user/{user}', 'API\UserController@destory');
    Route::put('user/ban/{user}', 'API\UserController@ban');
});
Route::apiResources([
    'test' => 'API\TestController',
]);
