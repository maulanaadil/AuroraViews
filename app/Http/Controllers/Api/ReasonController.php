<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\ReasonRequest;
use App\Services\ReasonService;

class ReasonController extends Controller
{
    protected $reasonService;

    public function __construct(ReasonService $reasonService)
    {
        $this->reasonService = $reasonService;
    }

    /**
     * Display a listing of the reason.
     */
    public function getAllReason()
    {
        return $this->reasonService->getAllReason();
    }

    /**
     * Display the specified reason.
     */
    public function getReasonById(string $reasonId)
    {
        return $this->reasonService->getReasonById($reasonId);
    }

    /**
     * Store a newly created reason in storage.
     */
    public function insertReason(ReasonRequest $request)
    {
        return $this->reasonService->insertReason($request);
    }

    /**
     * Update the specified reason in storage.
     */
    public function updateReason(ReasonRequest $request, string $updateReason)
    {
        return $this->reasonService->updateReason($request, $updateReason);
    }
}
