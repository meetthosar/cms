<?php

namespace App\Repositories;

use App\Models\Leave;
use App\Repositories\BaseRepository;

/**
 * Class LeaveRepository
 * @package App\Repositories
 * @version July 24, 2020, 7:11 pm UTC
*/

class LeaveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'from_date',
        'to_date',
        'reason',
        'compoff',
        'compoffreason',
        'created_by',
        'updated_by',
        'deleted_by'
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
        return Leave::class;
    }
}
