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
Route::get('static/videos/{id}/{slug?}', function($id, $slug='') {
    return view('videos.static');
});

/** Admin Routes **/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::resource('bands', 'BandController');
    Route::resource('albums', 'AlbumController');
    Route::resource('songs', 'SongController');
    Route::resource('ipsums', 'IpsumController');
    Route::resource('tags', 'TagController');
    Route::resource('videos', 'VideoController');
    Route::get('/', function() {
        return view('admin.home');
    });
});
