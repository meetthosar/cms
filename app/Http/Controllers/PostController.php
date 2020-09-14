<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\PostTag;
use App\Repositories\PostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->all();

        return view('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {

            $post = $this->postRepository->create($input);

            $this->savePostImage($request, $post);

            $this->saveTags($post, $input);

            DB::commit();

            Flash::success(__('messages.saved', ['model' => __('models/posts.singular')]));

            return redirect(route('posts.index'));
        }catch (\Exception $e){
            DB::rollBack();
//            dd($e->getMessage());
            Flash::error(__('messages.not_saved', ['model' => __('models/posts.singular')]));
            return back()->withInput();
        }
    }

    /**
     * Display the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error(__('messages.not_found', ['model' => __('models/posts.singular')]));

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with(['post'=> $post, 'postComments' => $post->postComments]);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error(__('messages.not_found', ['model' => __('models/posts.singular')]));

            return redirect(route('posts.index'));
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param int $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error(__('messages.not_found', ['model' => __('models/posts.singular')]));

            return redirect(route('posts.index'));
        }

        DB::beginTransaction();
        try {

            $post = $this->postRepository->update($request->all(), $id);

            $this->savePostImage($request, $post);

            $this->saveTags($post, $request->all());

            DB::commit();

            Flash::success(__('messages.updated', ['model' => __('models/posts.singular')]));

            return redirect(route('posts.index'));
        }catch (\Exception $e){
            DB::rollBack();
            Flash::error(__('messages.not_saved', ['model' => __('models/posts.singular')]));
            return back()->withInput();
        }
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error(__('messages.not_found', ['model' => __('models/posts.singular')]));

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/posts.singular')]));

        return redirect(route('posts.index'));
    }

    public function saveTags($post, $input){
        $tags = $input['category_id'];
        if(in_array('other', $tags)) {
            if($input['category'] != '') {
                $tagArray = explode(',', $input['category']);
            unset($tags[array_search('other',$tags)]);
                foreach ($tagArray as $tag) {
                    $tagMo = Category::firstOrCreate(['category_name' => $tag]);
                    $tags[] = $tagMo->id;
                }
            }
        }

        PostTag::where('post_id', $post->id)->whereNotIn('category_id', $tags)->delete();
        foreach ($tags as $tag){
            PostTag::firstOrCreate(['post_id' => $post->id, 'category_id' => $tag]);
        }

    }

    private function savePostImage($request, $post){


        if($request->file('image') != '') {

            $rule = ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'];

            $validator = Validator::make($request->all(), $rule);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $imageName = $post->id . time() . '.' . $request->file('image')->getClientOriginalExtension();

//        $destinationPath = public_path()."images/profile"
            $request->file('image')->move(public_path('images/post_images'), $imageName);

            $post->image = $imageName;
            $post->save();
        }
    }
}
