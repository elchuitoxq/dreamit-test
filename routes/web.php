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
    return view('home');
});

Auth::routes();

Route::get('/{any?}', 'AppController@index')->where('any', '.*');

Route::group(['prefix' => '/api'], function(){
    //Usuarios
    Route::post('/user', 'UserController@index')->name('user.index');
    Route::post('/users', 'UserController@store')->name('user.store');
    Route::post('/users/create', 'UserController@create')->name('user.create');
    Route::post('/users/edit', 'UserController@update')->name('user.update');
    Route::post('/users/delete', 'UserController@destroy')->name('user.delete');
    //Edificios
    Route::post('/buildings', 'BuildingsController@store')->name('building.store');
    Route::post('/buildings/create', 'BuildingsController@create')->name('building.create');
    Route::post('/buildings/edit', 'BuildingsController@update')->name('building.update');
    Route::post('/buildings/delete', 'BuildingsController@destroy')->name('building.delete');
    //Listas de Bloqueos
    Route::post('/block-list', 'BlockListController@store')->name('block.list.store');
    Route::post('/block-list/create', 'BlockListController@create')->name('block.list.create');
    Route::post('/block-list/delete', 'BlockListController@destroy')->name('block.list.delete');
    //Accesos
    Route::post('/access-list/all', 'AccessController@all')->name('access.all');
    Route::post('/access-list/store', 'AccessController@store')->name('access.store');
    Route::post('/access-list/entry', 'AccessController@entry')->name('access.entry');
    Route::post('/access-list/exit', 'AccessController@exit')->name('access.exit');
});
