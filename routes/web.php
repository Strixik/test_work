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



Route::get('/', 'IndexController@index')->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/role', 'HomeController@role')->name('role');
    Route::get('/page1', 'HomeController@page1')->name('page1')->middleware('api.role1');
    Route::get('/page2', 'HomeController@page2')->name('page2')->middleware('api.role2');
});





