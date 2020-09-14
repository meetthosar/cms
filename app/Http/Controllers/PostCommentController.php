<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostCommentRequest;
use App\Http\Requests\UpdatePostCommentRequest;
use App\Repositories\PostCommentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostCommentController extends AppBaseController
{
    /** @var  PostCommentRepository */
    private $postCommentRepository;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->postCommentRepository = $postCommentRepo;
    }

    /**
     * Display a listing of the PostComment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $postComments = $this->postCommentRepository->all();

        return view('post_comments.index')
            ->with('postComments', $postComments);
    }

    /**
     * Show the form for creating a new PostComment.
     *
     * @return Response
     */
    public function create()
    {
        return view('post_comments.create');
    }

    /**
     * Store a newly created PostComment in storage.
     *
     * @param CreatePostCommentRequest $request
     *
     * @return Response
     */
    public function store(CreatePostCommentRequest $request)
    {
        $input = $request->all();

        $postComment = $this->postCommentRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/postComments.singular')]));

        return redirect(route('postComments.index'));
    }

    /**
     * Display the specified PostComment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $postComment = $this->postCommentRepository->find($id);

        if (empty($postComment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/postComments.singular')]));

            return redirect(route('postComments.index'));
        }

        return view('post_comments.show')->with('postComment', $postComment);
    }

    /**
     * Show the form for editing the specified PostComment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $postComment = $this->postCommentRepository->find($id);

        if (empty($postComment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/postComments.singular')]));

            return redirect(route('postComments.index'));
        }

        return view('post_comments.edit')->with('postComment', $postComment);
    }

    /**
     * Update the specified PostComment in storage.
     *
     * @param int $id
     * @param UpdatePostCommentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCommentRequest $request)
    {
        $postComment = $this->postCommentRepository->find($id);

        if (empty($postComment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/postComments.singular')]));

            return redirect(route('postComments.index'));
        }

        $postComment = $this->postCommentRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/postComments.singular')]));

        return redirect(route('postComments.index'));
    }

    /**
     * Remove the specified PostComment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postComment = $this->postCommentRepository->find($id);

        if (empty($postComment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/postComments.singular')]));

            return redirect(route('postComments.index'));
        }

        $this->postCommentRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/postComments.singular')]));

        return redirect(route('postComments.index'));
    }
}
