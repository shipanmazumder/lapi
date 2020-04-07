<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return redirect()->route("login");
});

/**
 * admin route
 */
Route::group(['prefix'=>'admin','middleware'=>['auth'],'namespace'=>'Admin','as'=>'admin.'],function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/users', 'UserController@index')->name('user');
    Route::get('/user-view', 'UserController@view');
    Route::get('/user-ban/{user_id}', 'UserController@ban');
    Route::get('/user-delete/{user_id}', 'UserController@destory');
    Route::get('/user-edit/{user_id}', 'UserController@userEdit');
    Route::put('/user-edit/{user_id}', 'UserController@update');

});
/**
 * universal route
 */
Route::group(['middleware' => ['auth']], function () {
    Route::get('/password-change', 'PasswordController@index')->name('password_change');
    Route::post('/password-change', 'PasswordController@changePassword');
});
