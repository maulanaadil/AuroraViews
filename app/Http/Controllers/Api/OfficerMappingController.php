<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\MappingOfficer\FormMappingOfficerRequest;
use App\Request\MappingOfficer\SelectAreaByOfficerIdRequest;
use App\Request\MappingOfficer\SelectBlockByIdRequest;
use App\Request\MappingOfficer\SelectRegionalByIdRequest;
use App\Services\OfficerMappingService;

class OfficerMappingController extends Controller
{
    protected $officerMappingService;

    public function __construct(OfficerMappingService $officerMappingService)
    {
        $this->officerMappingService = $officerMappingService;
    }

    /**
     * Display the specified regional.
     */
    public function getSelectedRegionalById(SelectRegionalByIdRequest $request)
    {
        $this->getSelectedRegionalById($request);
    }

    /**
     * Display the specified block.
     */
    public function getSelectedBlocksById(SelectBlockByIdRequest $request)
    {
        $this->getSelectedBlocksById($request);
    }

    /**
     * Display the area data by officer id.
     */
    public function getAreaByOfficerId(SelectAreaByOfficerIdRequest $request)
    {
        $this->getAreaByOfficerId($request);
    }

    /**
     * Store a newly created mapping officer in storage..
     */
    public function insertMappingOfficer(FormMappingOfficerRequest $request)
    {
        $this->insertMappingOfficer($request);
    }

    /**
     * Remove the specified officer area from storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function deleteMappingOfficer(string $mappingOfficerId)
    {
        $this->deleteMappingOfficer($mappingOfficerId);
    }
}
