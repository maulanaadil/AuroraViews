<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Request\Authentication\LoginRequest;
use App\Request\Authentication\RegisterRequest;
use App\Services\AuthenticationService;

class AuthenticationController extends Controller
{
    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * handle login user
     */
    public function login(LoginRequest $request)
    {
        return $this->authenticationService->login($request);
    }

    /**
     * handle register user
     */
    public function register(RegisterRequest $request)
    {
        return $this->authenticationService->register($request);
    }
}
