<?php

namespace App\Repositories\Authentication;

use App\Models\User;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Login user
     */
    public function login(array $credentials)
    {
        return auth()->guard('api')->attempt($credentials);
    }

    /**
     * Register user
     */
    public function register(array $data)
    {
        return $this->userModel->create($data);
    }
}
