<?php

namespace App\Services;

use App\Repositories\Block\BlockRepository;
use App\Repositories\Officer\OfficerMappingRepository;
use App\Repositories\Officer\OfficerRepository;
use App\Request\MappingOfficer\SelectAreaByOfficerIdRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Http\Response;
use App\Iterators\BlockIdsIterator;
use App\Repositories\OfficerMapping\OfficerMappingRepositoryInterface;


class AreaService
{
    protected $officerMappingRepository;

    protected $officerRepository;

    protected $blockRepository;

    public function __construct(OfficerMappingRepository $officerMappingRepository, OfficerRepository $officerRepository, BlockRepository $blockRepository)
    {
        $this->officerMappingRepository = $officerMappingRepository;
        $this->officerRepository = $officerRepository;
        $this->blockRepository = $blockRepository;
    }

    /**
     * Display the area data by officer id.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function getAreaByOfficerId(SelectAreaByOfficerIdRequest $requestData)
    {
        try {
            // Get officer ID from the request data
            $officerId = $requestData->input('petugas_id');

            // Create the custom iterator
            $blockIdsIterator = new BlockIdsIterator($this->officerMappingRepository, $officerId);

            // Create an array to store the block IDs
            $blockIds = [];
            foreach ($blockIdsIterator as $blockId) {
                $blockIds[] = $blockId;
            }

            return ApiResponse::toJson(
                'Data block berhasil diambil',
                Response::HTTP_OK,
                true,
                [
                    // get officer data by officer id
                    'petugas' => $this->officerRepository->getOfficerById($officerId),
                    // get selected block by block ids
                    'area' => $this->blockRepository->getSelectedBlockByBulkId($blockIds),
                ]
            );
        } catch (Exception $exception) {
            return ApiResponse::toJson(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                false,
                null,
            );
        }
    }
}