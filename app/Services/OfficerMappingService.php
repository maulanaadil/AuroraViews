<?php

namespace App\Services;

use App\Repositories\Block\BlockRepository;
use App\Repositories\Officer\OfficerMappingRepository;
use App\Repositories\Officer\OfficerRepository;
use App\Request\MappingOfficer\FormMappingOfficerRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Http\Response;

class OfficerMappingService
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
    * Store a newly created mapping officer in storage.
    *
    * @return \Illuminate\Http\Response
    *
    * @throws \Exception
    */
   public function insertMappingOfficer(FormMappingOfficerRequest $requestData)
   {
       try {
           return ApiResponse::toJson(
               'Data berhasil ditambahkan',
               Response::HTTP_CREATED,
               true,
               $this->officerMappingRepository->insertMappingOfficer($requestData->validated())
           );
       } catch (Exception $exception) {
           return ApiResponse::toJson(
               $exception->getMessage(),
               Response::HTTP_INTERNAL_SERVER_ERROR, // Use the HTTP status code from the caught exception
               false,
               null
           );
       }
   }

    /**
     * Remove the specified officer area from storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function deleteMappingOfficer(string $mwriterAreaId)
    {
        try {
            // query to delete mapping officer
            $this->officerMappingRepository->deleteMappingOfficer($mwriterAreaId);

            return ApiResponse::toJson(
                'Data pemetaan petugas berhasil dihapus',
                Response::HTTP_OK,
                true,
                null,
            );
        } catch (Exception $exception) {
            return ApiResponse::toJson(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR, // Use the HTTP status code from the caught exception
                false,
                null,
            );
        }
    }
}
