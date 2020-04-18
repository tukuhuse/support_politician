<?php

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

/*
Route::get('/', function() {
    return view('welcome');
});
*/

Route::get('/', 'Admin\NotLoginController@top');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/user/index', 'UserprofilesController@index');
//Route::get('/user/show/{user}', 'UserprofilesController@show');
Route::resource('users','UserprofilesController');

/*Route::group(['prefix' => 'admin'], function() {
    Route::get('user/show_detail', 'Admin\UserController@show_detail')->middleware('auth');
    Route::get('/logout',[
        'uses' => 'Admin\UserController@getLogout',
        'as' => 'user.logout'
        ]);
});*/

/*
Route::group(['prefix' => 'admin'], function() {
    Route::get('user/create', 'Admin\UserController@add'->middleware('auth'));
});
*/
