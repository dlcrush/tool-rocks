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

Route::get('/', 'HomeController@getHome');

/** Ipsum */
Route::get('ipsum', 'IpsumController@generate');

/** Daily Fix */
Route::get('dailyfix', 'VideoController@getDailyFix');

/** Videos */
Route::get('videos/random', 'VideoController@getRandomVideo');
Route::get('videos/search', 'VideoController@getSearch');
Route::get('videos/{id}/{slug?}', 'VideoController@getVideo');
Route::get('videos', 'VideoController@getVideos');
//Route::post('videos/search', 'VideoController@postSearch');

/** Lyrics */
Route::get('lyrics', 'LyricController@getLyrics');
Route::get('lyrics/song/{songId}', 'LyricController@getLyric');

/** Tours */
Route::get('tours', 'TourController@getTours');
Route::get('tours/{id}', 'TourController@getTour');
Route::get('tours/{tourId}/shows/{showId}/{slug?}', 'TourController@getShow');

/** TV */
Route::get('tv', 'TVController@index');

/** Blog */
Route::get('blog', 'BlogController@getPosts');
Route::get('blog/post/{id}/{slug?}', 'BlogController@getPost');
Route::get('about', 'BlogController@getAbout');
Route::get('links', 'BlogController@getLinks');
Route::get('contact', 'BlogController@getContact');

/** Maynardisms */
Route::get('maynardisms', 'MaynardismController@getMaynardisms');
Route::get('maynardisms/{id}', 'MaynardismController@getMaynardism');

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
    Route::resource('maynardisms', 'MaynardismController');
    Route::get('maynardisms/{id}/delete', 'MaynardismController@delete');
    Route::get('/', function() {
        return view('admin.home');
    });
});

Auth::routes(['register' => false]);
