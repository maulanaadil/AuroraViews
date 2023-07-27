<?php

namespace App\Services;

use App\Repositories\Block\BlockRepository;
use App\Repositories\Officer\OfficerMappingRepository;
use App\Repositories\Officer\OfficerRepository;
use App\Request\MappingOfficer\SelectAreaByOfficerIdRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Http\Response;

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
   public function getAreaByOfficerId(SelectAreaByOfficerIdRequest $request)
   {
       try {
           // craete temporary array for block ids
           $blockIds = [];

           // get selected area by officer id
           $selectedAreaByOfficerId = $this->officerMappingRepository->getSelectedAreaByOfficerId($request->input('petugas_id'));

           // loop selected area by officer id and push block id to temporary array
           foreach ($selectedAreaByOfficerId as $itemArea) {
               // push block id to temporary array
               $blockIds[] = $itemArea->blockId;
           }

           return ApiResponse::toJson(
               'Data block berhasil diambil',
               Response::HTTP_OK,
               true,
               [
                   // get officer data by officer id
                   'petugas' => $this->officerRepository->getOfficerById($request->input('petugas_id')),
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
