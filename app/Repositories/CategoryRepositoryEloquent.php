<?php

namespace BluesFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use BluesFlix\Repositories\CategoryRepository;
use BluesFlix\Models\Category;
use BluesFlix\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace BluesFlix\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
