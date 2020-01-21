<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Api\ApiController@login')->name('login');
Route::post('/logout', 'Api\ApiController@logout')->name('logout');
Route::middleware(['api.auth'])->group(function () {
    Route::get('/role', 'Api\ApiController@role')->name('role');
    Route::get('/method1', 'Api\ApiController@method1')->name('method1')->middleware('api.role1');
    Route::get('/method2', 'Api\ApiController@method2')->name('method2')->middleware('api.role2');
});


