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
  Route::resource('bands', 'BandController');
  Route::resource('albums', 'AlbumController');
  Route::resource('songs', 'SongController');
  Route::resource('videos', 'VideoController');
  Route::resource('ipsums', 'IpsumController');
});
