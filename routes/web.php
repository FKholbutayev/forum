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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('threads', 'ThreadController')

Route::get('/threads', 'ThreadController@index')->name('thread.index');
Route::get('/threads/create', 'ThreadController@create')->name('thread.create');
Route::get('/threads/{channel}', 'ThreadController@index');

Route::post('/threads', 'ThreadController@store')->name('thread.store');

Route::get('/threads/{channel}/{thread}', 'ThreadController@show')->name('thread.show');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy')->name('thread.delete');

Route::patch('/replies/{reply}', 'RepliesController@update')->name('reply.update');
Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index')->name('reply.index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('reply.store');

Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('reply.destroy');

Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile.show');
