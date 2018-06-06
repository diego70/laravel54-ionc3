<?php

namespace BluesFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use BluesFlix\Models\User;
use UserVerifcation;


/**
 * Class UserRepositoryEloquent
 * @package namespace BluesFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function create(array $attributes)
    {
        $attributes['role'] = User::ROLE_ADMIN;
        $attributes['password'] = User::generatePassword();
        $model = parent::create($attributes);
        UserVerifcation::generate($model);
        UserVerifcation::send($model, 'Sua conta foi criada');
        return $model;
    }


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
