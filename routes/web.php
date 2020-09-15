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

Route::get('/tag/{tag_id}',function ($tag_id){
    $posts = \App\Models\Post::whereIn('id', \App\Models\PostTag::where('category_id', $tag_id)->pluck('post_id','id')->toArray())->get();
    return view('welcome')->with(compact('posts'));
})->name('tag');

Route::get('/single/{post_id}', function ($post_id){
   $post = \App\Models\Post::find($post_id);
    return view('single')->with(compact('post'));
})->name('single');

Route::post('/', function (\Illuminate\Http\Request $request) {
    $input = $request->all();
    $posts = \App\Models\Post::where('post_title','LIKE', '%'.$input['search'].'%')
        ->get();
    $search = $input['search'];

    return view('welcome')->with(compact('posts', 'search'));
});


Auth::routes(['verify' => true]);



Route::group(['middleware' => 'auth'], function() {
    Route::post('/comment', function (\Illuminate\Http\Request $request){
        if ($request->input('comment') != ''){
            $postComment = \App\Models\PostComment::create([
                'post_id' => $request->input('post_id'),
                'comment' => $request->input('comment')
            ]);
            return redirect(route('single', [ $request->input('post_id')]));
        }

    })->name('comment');

    Route::get('/home', 'HomeController@index')->middleware('verified');
    Route::resource('categories', 'CategoryController');

    Route::resource('posts', 'PostController');

    Route::resource('postComments', 'PostCommentController');
});
