<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\Block\SelectBlockByIdRequest;
use App\Request\MappingOfficer\FormMappingOfficerRequest;
use App\Request\MappingOfficer\SelectAreaByOfficerIdRequest;
use App\Request\Regional\SelectRegionalByIdRequest;
use App\Services\AreaService;
use App\Services\BlockService;
use App\Services\OfficerMappingService;
use App\Services\RegionalService;

class OfficerMappingController extends Controller
{
    protected $officerMappingService;

    protected $regionalService;

    protected $blockService;

    protected $areaService;

    public function __construct(OfficerMappingService $officerMappingService, RegionalService $regionalService, BlockService $blockService, AreaService $areaService)
    {
        $this->officerMappingService = $officerMappingService;
        $this->regionalService = $regionalService;
        $this->blockService = $blockService;
        $this->areaService = $areaService;
    }

    /**
     * Display the specified regional.
     */
    public function getSelectedRegionalById(string $regionalId)
    {
        return $this->regionalService->getSelectedRegionalById($regionalId);
    }

    /**
     * Display the specified block.
     */
    public function getSelectedBlocksById(SelectBlockByIdRequest $requestData)
    {
       return $this->blockService->getSelectedBlocksById($requestData);
    }

    /**
     * Display the area data by officer id.
     */
    public function getAreaByOfficerId(SelectAreaByOfficerIdRequest $requestData)
    {
        return $this->areaService->getAreaByOfficerId($requestData);
    }

    /**
     * Store a newly created mapping officer in storage..
     */
    public function insertMappingOfficer(FormMappingOfficerRequest $requestData)
    {
       return  $this->officerMappingService->insertMappingOfficer($requestData);
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
        return $this->officerMappingService->deleteMappingOfficer($mappingOfficerId);
    }
}
