<?php

namespace BluesFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use BluesFlix\Repositories\VideoRepository;
use BluesFlix\Models\Video;
use BluesFlix\Validators\VideoValidator;

/**
 * Class VideoRepositoryEloquent
 * @package namespace BluesFlix\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Video::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
