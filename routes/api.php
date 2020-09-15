<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', ['as' => 'login', 'uses' => 'UserAPIController@login']);
Route::get('/listing',['as' => 'listing', 'uses' => 'PostAPIController@listing'] );
Route::post('/listing',['as' => 'listing', 'uses' => 'PostAPIController@listing'] );
Route::get('/single/{post_id}',['as' => 'single', 'uses' => 'PostAPIController@single'] );

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/post',['as' => 'post.store', 'uses' => 'PostAPIController@store']);
});
