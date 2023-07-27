<?php

namespace App\Services;

use App\Repositories\Officer\OfficerMappingRepository;
use App\Repositories\Officer\OfficerRepository;
use App\Request\MappingOfficer\FormMappingOfficerRequest;
use App\Request\MappingOfficer\SelectAreaByOfficerIdRequest;
use App\Request\MappingOfficer\SelectBlockByIdRequest;
use App\Request\MappingOfficer\SelectRegionalByIdRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Http\Response;

class OfficerMappingService
{
    protected $officerMappingRepository;

    protected $officerRepository;

    public function __construct(OfficerMappingRepository $officerMappingRepository, OfficerRepository $officerRepository)
    {
        $this->officerMappingRepository = $officerMappingRepository;
        $this->officerRepository = $officerRepository;
    }

   /**
    * Display the specified regional.
    *
    * @return \Illuminate\Http\Response
    *
    * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
    * @throws \Exception
    */
   public function getSelectedRegionalById(SelectRegionalByIdRequest $request)
   {
       try {
           return ApiResponse::toJson(
               'Data regional berhasil diambil',
               Response::HTTP_OK,
               true,
               $this->officerMappingRepository->getSelectedRegionalById($request->validated()),
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

   /**
    * Display the specified block.
    *
    * @return \Illuminate\Http\Response
    *
    * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
    * @throws \Exception
    */
   public function getSelectedBlocksById(SelectBlockByIdRequest $request)
   {
       try {
           return ApiResponse::toJson(
               'Data block berhasil diambil',
               Response::HTTP_OK,
               true,
               $this->officerMappingRepository->getSelectedBlocksById($request->validated()),
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
                   'petugas' => $this->officerRepository->getOfficerById($request->input('petugas_id')),
                   'area' => $this->officerMappingRepository->getSelectedBlockByBulkId($blockIds),
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

   /**
    * Store a newly created mapping officer in storage.
    *
    * @return \Illuminate\Http\Response
    *
    * @throws \Exception
    */
   public function insertMappingOfficer(FormMappingOfficerRequest $request)
   {
       try {
           return ApiResponse::toJson(
               'Data berhasil ditambahkan',
               Response::HTTP_CREATED,
               true,
               $this->officerMappingRepository->insertMappingOfficer($request->validated())
           );
       } catch (Exception $exception) {
           return ApiResponse::toJson(
               $exception->getMessage(),
               $exception->getCode(), // Use the HTTP status code from the caught exception
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
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
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
                $exception->getCode(), // Use the HTTP status code from the caught exception
                false,
                null,
            );
        }
    }
}
