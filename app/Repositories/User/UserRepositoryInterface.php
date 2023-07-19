<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers(): Collection;

    public function getUserById(string $userId): User;

    public function insertUser(array $newDataUser): User;

    public function deleteUser(string $userId): bool;
}
