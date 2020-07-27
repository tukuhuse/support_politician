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


Route::get('/','parliamentController@search')->name('search');
Route::get('parliament/index','parliamentController@index')->name('index');
Route::get('parliament/show/{issueID}','parliamentController@show')->name('show');

Auth::routes();
Route::resource('users','UserprofilesController',['except' => ['create','store']])->middleware('auth');
Route::resource('comments','CommentController', ['only' => ['store','destroy']]);
Route::get('datasetting','dataController@legislator')->name('datasetting');
Route::post('ajaxupdate','goodController@ajaxupdate')->name('ajaxupdate')->middleware('auth');
route::post('legislator_import','dataimportController@store')->name('legislator_import');