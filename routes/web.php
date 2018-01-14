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
    return view('home');
});

Route::get('ipsum', 'IpsumController@generate');
Route::get('videos/{id}/{slug?}', 'VideoController@getVideo');
Route::get('videos', 'VideoController@getVideos');
Route::get('lyrics', 'LyricController@getLyrics');
Route::get('lyrics/song/{songId}', 'LyricController@getLyric');

/** Admin Routes **/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['AdminAuth']], function() {
    Route::resource('bands', 'BandController');
    Route::get('bands/{id}/delete', 'BandController@delete');
    Route::resource('albums', 'AlbumController');
    Route::get('albums/{id}/delete', 'AlbumController@delete');
    Route::resource('songs', 'SongController');
    Route::get('songs/{id}/delete', 'SongController@delete');
    Route::resource('ipsums', 'IpsumController');
    Route::get('ipsums/{id}/delete', 'IpsumController@delete');
    Route::resource('shows', 'ShowController');
    Route::get('shows/{id}/delete', 'ShowController@delete');
    Route::resource('tags', 'TagController');
    Route::get('tags/{id}/delete', 'TagController@delete');
    Route::resource('tours', 'TourController');
    Route::get('tours/{id}/delete', 'TourController@delete');
    Route::resource('videos', 'VideoController');
    Route::get('videos/{id}/delete', 'VideoController@delete');
    Route::get('/', function() {
        return view('admin.home');
    });
});
