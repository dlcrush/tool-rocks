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
    /** Bands **/
    Route::get('bands', 'BandController@getBands');
    Route::get('bands/{bandId}/albums', 'BandController@getAlbums');
    Route::get('bands/{bandId}/albums/{albumId}', 'BandController@getAlbum');
    Route::get('bands/{bandId}/songs', 'BandController@getSongs');

    /** Videos **/
    Route::get('videos', 'VideoController@getVideos');

    /** Tags **/
    Route::get('tags', 'TagController@getTags');
    Route::get('tags/{id}', 'TagController@getTag');

    /** Ipsums **/
    Route::get('ipsums', 'IpsumController@getIpsums');
    Route::get('ipsums/{id}', 'IpsumController@getIpsum');

    /** YouTube **/
    Route::get('youtube/video/{id}', 'YouTubeController@getVideo');
    Route::get('youtube/videos', 'YouTubeController@getVideos');
    Route::get('youtube/channel/{channelName}/videos', 'YouTubeController@getVideosByChannel');
    Route::get('youtube/channel/{id}', 'YouTubeController@getChannel');
});
