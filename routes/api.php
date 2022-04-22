<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->name('api.')->group(function() { 
    Route::get("/doctors", "DoctorController@index")->name('doctors');
    Route::get("/doctors/set/page_items", "DoctorController@setMaxPageItems")->name('doctors');
    Route::get("/doctors/get/page_links", "DoctorController@getPageNumbers")->name('doctors');
    Route::get("/doctors/{doctor:id}", "DoctorController@show")->name('doctors.show');
});