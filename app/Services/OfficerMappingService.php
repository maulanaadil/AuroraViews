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
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
       } catch (ModelNotFoundException $exception) {
           return ApiResponse::toJson(
               'Data dengan id '.$request->validated()['regional_id'].' tidak ditemukan',
               Response::HTTP_NOT_FOUND,
               false,
               null,
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
       } catch (ModelNotFoundException $exception) {
           return ApiResponse::toJson(
               'Data dengan id '.$request->validated()['block_id'].' tidak ditemukan',
               Response::HTTP_NOT_FOUND,
               false,
               null,
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
           $block_ids = [];

           $officerId = $request->input('petugas_id');

           $selectedAreaByOfficerId = $this->officerMappingRepository->getSelectedAreaByOfficerId($officerId);

           foreach ($selectedAreaByOfficerId as $itemArea) {
               $block_ids[] = $itemArea->block_id;
           }

           return ApiResponse::toJson(
               'Data block berhasil diambil',
               Response::HTTP_OK,
               true,
               [
                   'petugas' => $this->officerRepository->getOfficerById($officerId),
                   'area' => $this->officerMappingRepository->getSelectedBlockByBulkId($block_ids),
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
           // check if officer data exist
           if (empty($this->officerRepository->getOfficerById(
               $request->validated()['petugas_id']
           ))) {
               throw new Exception('Data dengan id '.$request->validated()['petugas_id'].' tidak ditemukan', Response::HTTP_NOT_FOUND);
           }

           // check if regional data exist
           if (empty($this->officerMappingRepository->getSelectedRegionalById(
               $request->validated()['regional_id']
           ))) {
               throw new Exception('Data dengan id '.$request->validated()['regional_id'].' tidak ditemukan', Response::HTTP_NOT_FOUND);
           }

           // check if block data exist
           if (empty($this->officerMappingRepository->getSelectedBlocksById(
               $request->validated()['block_id']
           ))) {
               throw new Exception('Data dengan id '.$request->validated()['block_id'].' tidak ditemukan', Response::HTTP_NOT_FOUND);
           }

           // check if area data exist
           if (! empty($this->officerMappingRepository->getSelectedAreaByOfficerId(
               $request->validated()['petugas_id']
           ))) {
               throw new Exception('Data dengan id '.$request->validated()['petugas_id'].' sudah terdaftar', Response::HTTP_NOT_FOUND);
           }

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
            $this->officerMappingRepository->deleteMappingOfficer($mwriterAreaId);

            return ApiResponse::toJson(
                'Data pemetaan petugas berhasil dihapus',
                Response::HTTP_OK,
                true,
                null,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data dengan id '.$mwriterAreaId.' tidak ditemukan',
                Response::HTTP_NOT_FOUND,
                false,
                null,
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
