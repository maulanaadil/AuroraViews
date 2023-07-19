<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Get all user data
     */
    public function getAllUsers(): Collection
    {
        return $this->userModel->all();
    }

    /**
     * Get user data by Id
     */
    public function getUserById(string $userId): User
    {
        return $this->userModel->findOrFail($userId);
    }

    /**
     * Insert user data
     */
    public function insertUser(array $newDataUser): User
    {
        return $this->userModel->create($newDataUser);
    }

    /**
     * Delete user data
     */
    public function deleteUser(string $userId): bool
    {
        $user = $this->getUserById($userId);

        return $user->delete();
    }
}
