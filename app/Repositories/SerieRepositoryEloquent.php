<?php

namespace BluesFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use BluesFlix\Repositories\SerieRepository;
use BluesFlix\Models\Serie;
use BluesFlix\Validators\SerieValidator;

/**
 * Class SerieRepositoryEloquent
 * @package namespace BluesFlix\Repositories;
 */
class SerieRepositoryEloquent extends BaseRepository implements SerieRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Serie::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
