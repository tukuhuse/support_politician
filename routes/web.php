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
Route::get('outcome','kokkaiapi@find_comment')->name('outcome');
Route::get('outcome/detail/{issueID}','kokkaiapi@detail_topic')->name('detail');

Route::get('topic2','kokkaiapi@search_legislator_topic')->name('topic2');
Route::get('outcome2','kokkaiapi@result_legislator_index')->name('outcome2');
Route::get('outcome3','kokkaiapi@result_constituency_index')->name('outcome3');
Route::get('outcome4','kokkaiapi@result_speakergroup_index')->name('outcome4');

Auth::routes();
Route::resource('users','UserprofilesController')->middleware('auth');
Route::resource('comments','CommentController');
Route::get('datasetting','dataController@legislator')->name('datasetting');
Route::post('goodstate','goodController@goodstatechange')->name('goodstate');
