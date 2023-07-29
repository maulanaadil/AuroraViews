<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the user.
     */
    public function getAllUsers()
    {
        return $this->userService->getAllUsers();
    }

    /**
     * Display the specified user.
     */
    public function getUserById(string $userId)
    {
        return $this->userService->getUserById($userId);
    }

    /**
     * Store a newly created user in storage.
     */
    public function insertUser(UserRequest $requestData)
    {
        return $this->userService->insertUser($requestData);
    }

    /**
     * delete the specified user in storage.
     */
    public function deleteUser(string $userId)
    {
        return $this->userService->deleteUser($userId);
    }
}
