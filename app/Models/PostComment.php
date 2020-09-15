<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableTrait;

/**
 * Class PostComment
 * @package App\Models
 * @version September 14, 2020, 12:42 pm UTC
 *
 * @property \App\Models\Post $post
 * @property integer $post_id
 * @property string $comment
 * @property integer $parent_comment_id
 * @property integer $created_by
 * @property integer $updated_by
 */
class PostComment extends Model
{
    use SoftDeletes;
    use AuditableTrait;

    public $table = 'post_comments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'post_id',
        'comment',
        'parent_comment_id',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'comment' => 'string',
        'parent_comment_id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'post_id' => 'required',
        'comment' => 'required|string',
        'parent_comment_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'created_by' => 'nullable',
        'updated_by' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }

}
