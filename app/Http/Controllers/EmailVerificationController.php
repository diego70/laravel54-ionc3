<?php

namespace BluesFlix\Http\Controllers;

use BluesFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jrean\UserVerification\Traits\VerifiesUsers;

class EmailVerificationController extends Controller
{
    use VerifiesUsers;

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function redirectAfterVerification()
    {
        $this->loginUser();
        return url('user_settings.edit');
    }

    protected function loginUser(){
        $email = \Request::get('email');
        $user = $this->repository->findByField('email',$email)->first();
        Auth::login($user);
    }
}
