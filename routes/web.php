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
    $posts = \App\Models\Post::inRandomOrder()
        ->get();

    return view('welcome')->with(compact('posts'));
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::group(['middleware' => 'auth'], function() {

    Route::resource('categories', 'CategoryController');

    Route::resource('posts', 'PostController');

    Route::resource('postComments', 'PostCommentController');
});
