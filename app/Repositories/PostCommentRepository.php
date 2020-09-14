<?php

namespace App\Repositories;

use App\Models\PostComment;
use App\Repositories\BaseRepository;

/**
 * Class PostCommentRepository
 * @package App\Repositories
 * @version September 14, 2020, 12:42 pm UTC
*/

class PostCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'comment',
        'parent_comment_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostComment::class;
    }
}
