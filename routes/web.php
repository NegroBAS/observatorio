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

Route::get('/violentometro', 'PaginaController@violentometro')->name('violentometro');

Route::resource('messages', 'MessageController');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('violencemeters', 'ViolencemeterController');
});

Route::get('/home', 'HomeController@index')->name('home');
