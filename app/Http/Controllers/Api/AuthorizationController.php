<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\AuthorizationRequest;
use App\Services\AuthorizationService;

class AuthorizationController extends Controller
{
    protected $authorizationService;

    public function __construct(AuthorizationService $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }

    /**
     * Display a listing of the authorization.
     */
    public function getAllAuthorization()
    {
        return $this->authorizationService->getAllAuthorization();
    }

    /**
     * Store a newly created authorization in storage.
     */
    public function insertAuthorization(AuthorizationRequest $request)
    {
        return $this->authorizationService->insertAuthorization($request);
    }

    /**
     * delete the specified authorization in storage.
     */
    public function deleteAuthorization(string $authorizationId)
    {
        return $this->authorizationService->deleteAuthorization($authorizationId);
    }
}
