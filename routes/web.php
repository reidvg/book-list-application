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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/* CRUD Controllers */
Route::resource('book-list', 'UserBookListController');
Route::resource('book-list.reading-list', 'ListController')->only(['index', 'store']);
Route::resource('book', 'BookController');
