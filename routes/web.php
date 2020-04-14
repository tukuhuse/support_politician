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
Route::get('/data', 'Admin\NotLoginController@datashow');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function() {
    Route::get('user/show_detail', 'Admin\UserController@show_detail');
});

/*
Route::group(['prefix' => 'admin'], function() {
    Route::get('user/create', 'Admin\UserController@add'->middleware('auth'));
});
*/
