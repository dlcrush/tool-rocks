<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'API'], function() {
    Route::get('bands', 'BandController@getBands');
    Route::get('bands/{id}/albums', 'BandController@getAlbums');
    Route::get('bands/{id}/songs', 'BandController@getSongs');
    Route::resource('albums', 'AlbumController');
    Route::resource('songs', 'SongController');
    Route::resource('videos', 'VideoController');
    Route::resource('tags', 'TagController');
    Route::resource('ipsums', 'IpsumController');
    Route::get('youtube/video/{id}', 'YouTubeController@show');
    Route::get('youtube/videos', 'YouTubeController@getVideos');
    Route::get('youtube/channel/{channelName}/videos', 'YouTubeController@getVideosByChannel');
    Route::get('youtube/channel/{id}', 'YouTubeController@getChannel');
});
