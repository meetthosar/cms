<?php

namespace App\Http\Controllers\API;


use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;


/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class PostAPIController extends AppBaseController
{
    public $successStatus = 200;

    /**
     * Listing api
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request){
        $input = $request->all();

        if (!isset($input['search'])) {
            $posts = \App\Models\Post::inRandomOrder()
                ->get();
        }else {
            $posts = \App\Models\Post::where('post_title', 'LIKE', '%' . $input['search'] . '%')
                ->get();
        }
        return response()->json(['posts' => $posts], 200);
    }


    public function single($post_id){
        $post = \App\Models\Post::find($post_id);
        return response()->json(['post' => $post], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $post = Post::create([
                'post_title' => $request->input('title'),
                'description' => $request->input('description')
            ]);

            $post->savePostTags($request->all());
            DB::commit();
            return response()->json(['success' => 'Post Created'], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Post Not Created'], 500);
        }

    }

}
