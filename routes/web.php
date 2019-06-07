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
Route::get('/home', function ()
{
    return view('welcome');
});

//Profile Related Routes
Route::get('/u/{user}', 'ProfilesController@view')->name('profile.show');
Route::get('u/{id}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::put('u/{id}', 'ProfilesController@update')->name('profile.update');

//Post Related Routes. Authenticated Only
Route::get('/p', 'PostsController@create')->middleware('auth');
Route::get('/p/{post}', 'PostsController@view');
Route::post('/p', 'PostsController@store')->middleware('auth');

Route::post('/follow/{user}', 'FollowersController@follow');
