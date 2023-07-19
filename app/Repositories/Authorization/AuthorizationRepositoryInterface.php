<?php

namespace App\Repositories\Authorization;

use App\Models\Hak;
use Illuminate\Database\Eloquent\Collection;

interface AuthorizationRepositoryInterface
{
    public function getAllAuthorization(): Collection;

    public function insertAuthorization(array $newDataAuthorization): Hak;

    public function getAuthorizationById(string $authorizationId): Hak;

    public function deleteAuthorization(string $authorizationId): bool;
}
