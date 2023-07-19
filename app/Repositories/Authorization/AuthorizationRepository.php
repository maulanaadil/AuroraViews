<?php

namespace App\Repositories\Authorization;

use App\Models\Hak;
use Illuminate\Database\Eloquent\Collection;

class AuthorizationRepository implements AuthorizationRepositoryInterface
{
    protected $authorizationModel;

    public function __construct(Hak $authorizationModel)
    {
        $this->authorizationModel = $authorizationModel;
    }

    /**
     * Get all authorization data
     */
    public function getAllAuthorization(): Collection
    {
        return $this->authorizationModel->all();
    }

    /**
     * Insert authorization data
     */
    public function insertAuthorization(array $newDataAuthorization): Hak
    {
        return $this->authorizationModel->create($newDataAuthorization);
    }

    /**
     * Get authorization data by Id
     */
    public function getAuthorizationById(string $authorizationId): Hak
    {
        return $this->authorizationModel->findOrFail($authorizationId);
    }

    /**
     * Delete existing authorization data
     */
    public function deleteAuthorization(string $authorizationId): bool
    {
        $authorization = $this->getAuthorizationById($authorizationId);

        return $authorization->delete();
    }
}
