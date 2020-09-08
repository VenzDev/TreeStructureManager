<?php

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
    return redirect('/trees');
});

Route::resource('/trees','TreeController');

Route::get("/trees/createChildren/{id}",'TreeController@createChildren')->name('trees.createChildren');

Route::get("/trees/destroy/{id}",'TreeController@deleteForm')->name('trees.deleteForm'); 
