<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('people',['uses' => 'PeopleController@store']);
Route::post('tag',['uses' => 'TagController@store']);
Route::post('relation',['uses' => 'RelationController@store']);

Route::get('people_names',['uses' => 'PeopleController@show']);
Route::get('tag_names',['uses' => 'TagController@show']);
Route::post('tag/update/{id}',['uses' => 'TagController@update']);
Route::post('view_relation',['uses' => 'RelationController@fetch']);