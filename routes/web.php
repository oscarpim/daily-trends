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

//Vista de inicio
Route::get('/', function () {
    return view('welcome');
});
//Vista general de feeds
Route::get('/feeds', 'FeedController@insideLinks');

//Vista de un solo feed
Route::get('/unico/{id}', 'CrudController@read');

//Vista creacion de un nuevo feed manual
Route::get('/new-feed', function () {
    return view('newfeed');
});
Route::post('/create', 'CrudController@create');





Route::get('/read', 'CrudController@read');
Route::post('/update/{id}', 'CrudController@update');
Route::delete('/delete/{id}', 'CrudController@delete');