<?php

namespace App\Repositories\Authentication;

interface AuthenticationRepositoryInterface
{
    public function login(array $credentials);

    public function register(array $data);
}
