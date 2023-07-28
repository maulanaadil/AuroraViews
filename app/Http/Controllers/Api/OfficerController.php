<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\OfficerRequest;
use App\Services\OfficerService;

class OfficerController extends Controller
{
    protected $officerService;

    public function __construct(OfficerService $officerService)
    {
        $this->officerService = $officerService;
    }

    /**
     * Display a listing of the officer.
     */
    public function getAllOfficer()
    {
        return $this->officerService->getAllOfficer();
    }

    /**
     * Display the specified officer by id.
     */
    public function getOfficerById(string $officerId)
    {
        return $this->officerService->getOfficerById($officerId);
    }

    /**
     * Store a newly created officer in storage.
     */
    public function insertOfficer(OfficerRequest $requestData)
    {
        return $this->officerService->insertOfficer($requestData);
    }

    /**
     * Update the specified officer in storage.
     */
    public function updateOfficer(OfficerRequest $requestData, string $updateOfficer)
    {
        return $this->officerService->updateOfficer($requestData, $updateOfficer);
    }

    /**
     * Remove the specified officer from storage.
     */
    public function deleteOfficer(string $officerId)
    {
        return $this->officerService->deleteOfficer($officerId);
    }
}
