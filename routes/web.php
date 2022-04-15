<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin') //namespace Admin dice che tutte le rotte vanno prese nel controller nella cartella Admin
    ->name('admin.') //tutte le rotte avranno all inizio admin.
    ->prefix('admin') //relativo a tutto le rotte (prefisso della url)
    ->group(function(){ 
        Route::get('/home', 'HomeController@index')->name('home');
        /* Route::get('/user/edit', 'UserEditController@edit')->name('user.edit'); */
        /* Route::put('/user', 'UserEditController@update')->name('user.update'); */ // no need for name here since we can use PUT method on edit-account.
        Route::resource('/user', 'UserController');/* ->except(['edit', 'update']); */
        /* Route::patch("comments/{comment}","CommentController@update")->name("comments.update");
        Route::delete("comments/{comment}", "CommentController@destroy")->name("comments.destroy"); */
    }); 
Route::get('/home', 'HomeController@index')->name('home');


/* rotte raggiungibili solo da /admin */
Route::middleware('auth')
->namespace('Admin') /* con questo diciamo dove devono puntare i vari Controllers */
->name('admin.')  /* base della rotta con dot notation da anteporre ai percorsi nel group */
->prefix('admin')
->group(function() { /* group() applica tutte le precedenti alle rotte definite dentro la sua function */
    Route::get("/", 'HomeController@index')->name('home'); /* indirizzo qui viene aggiunto a /admin */
    Route::resource("/users/{user:id}/messages", 'MessageController');
}); 
