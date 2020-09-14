<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Yajra\Auditable\AuditableTrait;

/**
 * Class Post
 * @package App\Models
 * @version September 14, 2020, 10:37 am UTC
 *
 * @property \App\Models\Category $category
 * @property \Illuminate\Database\Eloquent\Collection $postComments
 * @property integer $category_id
 * @property string $post_title
 * @property string $description
 * @property string $image
 * @property string $tags
 * @property integer $created_by
 * @property integer $updated_by
 */
class Post extends Model
{
    use SoftDeletes;
    use AuditableTrait;

    public $table = 'posts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
//        'category_id',
        'post_title',
        'description',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
//        'category_id' => 'integer',
        'post_title' => 'string',
        'description' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'required|array|min:1',
        'post_title' => 'required|string',
        'description' => 'required|string',
//        'image' => 'image|max:2048'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postComments()
    {
        return $this->hasMany(\App\Models\PostComment::class, 'post_id');
    }

    public function postTags(){
        return DB::table('post_tags AS pt')
            ->select('cat.id', 'cat.category_name')
            ->join('categories AS cat', 'cat.id', '=', 'pt.category_id')
            ->where('post_id', $this->id)->get();
    }
}
