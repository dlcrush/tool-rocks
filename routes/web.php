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
Route::get('video/test', function() {
    return view('videos.show');
});

// Admin routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::resource('band', 'BandController');
    Route::resource('album', 'AlbumController');
    Route::resource('song', 'SongController');
    Route::resource('ipsums', 'IpsumController');
    Route::resource('tags', 'TagController');
    Route::resource('videos', 'VideoController');
    Route::get('/', function() {
        return view('admin.home');
    });
    Route::get('video/preview', function() {
        return view('admin.videos.preview');
    });
});
