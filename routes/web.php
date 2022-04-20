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
    return view('front');
});

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin') //namespace Admin dice che tutte le rotte vanno prese nel controller nella cartella Admin
    ->name('admin.') //tutte le rotte avranno all inizio admin.
    ->prefix('admin') //relativo a tutto le rotte (prefisso della url)
    ->group(function(){ 
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('/user', 'UserController');/* ->except(['edit', 'update']); */
        Route::resource("/user/{user:id}/messages", 'MessageController')->except(['create', 'edit', 'store', 'update']);
        Route::resource("/user/{user:id}/reviews", 'ReviewController')->except(['create', 'show', 'edit', 'store', 'update']);
    }); 

Route::get('/{any}', function () {
    return view('front');
})->where('any', '.*');

// /* rotte raggiungibili solo da /admin */
// Route::middleware('auth')
// ->namespace('Admin') /* con questo diciamo dove devono puntare i vari Controllers */
// ->name('admin.')  /* base della rotta con dot notation da anteporre ai percorsi nel group */
// ->prefix('admin')
// ->group(function() { /* group() applica tutte le precedenti alle rotte definite dentro la sua function */
//     Route::get("/", 'HomeController@index')->name('home'); /* indirizzo qui viene aggiunto a /admin */
//     Route::resource("/users/{user:id}/messages", 'MessageController');
// }); 
