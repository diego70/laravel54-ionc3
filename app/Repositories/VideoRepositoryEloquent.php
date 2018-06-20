<?php

namespace BluesFlix\Repositories;

use BluesFlix\Media\ThumbUploads;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use BluesFlix\Models\Video;

/**
 * Class VideoRepositoryEloquent
 * @package namespace BluesFlix\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    use ThumbUploads;

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        if(isset($attributes['categories'])){
            $model->categories()->sync($attributes['categories']);
        }
        return $model;
    }

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
