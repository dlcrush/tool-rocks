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

Route::group(['prefix' => 'v1', 'namespace' => 'API', 'middleware' => ['APIAuth']], function() {
    /** Bands **/
    Route::get('bands', 'BandController@getBands');
    Route::get('bands/{bandId}', 'BandController@getBand');
    Route::get('bands/{bandId}/albums', 'BandController@getAlbums');
    Route::get('bands/{bandId}/albums/{albumId}', 'BandController@getAlbum');
    Route::get('bands/{bandId}/songs', 'BandController@getSongs');
    Route::get('bands/{bandId}/songs/{songId}', 'BandController@getSong');
    Route::get('bands/{bandId}/tours', 'BandController@getTours');
    Route::get('bands/{bandId}/tours/{tourId}', 'BandController@getTour');
    Route::get('bands/{bandId}/tours/{tourId}/shows/{showId}', 'BandController@getShow');

    /** Videos **/
    Route::get('videos', 'VideoController@getVideos');
    Route::get('videos/search', 'VideoController@searchVideos');
    Route::get('videos/{id}', 'VideoController@getVideo');

    /** Tags **/
    Route::get('tags', 'TagController@getTags');
    Route::get('tags/ingest', 'TagController@ingestTags');
    Route::get('tags/{id}', 'TagController@getTag');

    /** Ipsums **/
    Route::get('ipsums', 'IpsumController@getIpsums');
    Route::get('ipsums/{id}', 'IpsumController@getIpsum');

    /** YouTube **/
    Route::get('youtube/videos/{id}', 'YouTubeController@getVideo');
    Route::get('youtube/videos', 'YouTubeController@getVideos');
    Route::get('youtube/channels/{channelName}/videos', 'YouTubeController@getVideosByChannel');
    Route::get('youtube/channels/{id}', 'YouTubeController@getChannel');

    /** Pages */
    Route::get('pages', 'PageController@getPages');

    /** Posts */
    Route::get('posts', 'PostController@getPosts');
    Route::get('posts/{id}', 'PostController@getPost');

    /** WordPress */
    Route::get('wordpress/pages', 'WordPressController@getPages');

    Route::get('tv', 'TVcontroller@getTV');

    Route::get('bands/{bandId}/shows', 'SetlistController@getShows');
    Route::get('bands/{bandId}/info', 'SetlistController@getBand');
    Route::get('bands/{bandId}/shows/{year}', 'SetlistController@getShowsByYear');
    Route::get('ingest/bands/{bandId}/year/{year}', 'SetlistController@ingest');
    //Route::get('bands/{bandId}/shows/{year}/process', 'SetlistController@')

});
