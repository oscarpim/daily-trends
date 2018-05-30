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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/feeds', 'FeedController@insideLinks');
Route::get('/new-feed', function () {
    return view('newfeed');
});
Route::post('/create', 'CrudController@create');
Route::get('/read', 'CrudController@read');
Route::post('/update/{id}', 'CrudController@update');
Route::delete('/delete/{id}', 'CrudController@delete');