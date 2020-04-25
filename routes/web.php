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
Route::get('topic1','kokkaiapi@search_topic')->name('topic1');
Route::post('outcome','kokkaiapi@find_comment')->name('outcome');

Auth::routes();
Route::resource('users','UserprofilesController')->middleware('auth');

