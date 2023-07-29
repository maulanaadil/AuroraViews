<?php

namespace App\Services;

use App\Repositories\Officer\OfficerRepository;
use App\Request\OfficerRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class OfficerService
{
    protected $officerRepository;

    public function __construct(OfficerRepository $officerRepository)
    {
        $this->officerRepository = $officerRepository;
    }

   /**
    * Display a listing of the officer.
    *
    * @return \Illuminate\Http\Response
    *
    * @throws \Exception
    */
   public function getAllOfficer()
   {
       try {
           return ApiResponse::toJson(
               'Data petugas berhasil diambil',
               Response::HTTP_OK,
               true,
               $this->officerRepository->getAllOfficer(),
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
    * Display the specified officer by id.
    *
    * @return \Illuminate\Http\Response
    *
    * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
    * @throws \Exception
    */
   public function getOfficerById(string $officerId)
   {
       try {
           return ApiResponse::toJson(
               'Data petugas berhasil diambil',
               Response::HTTP_OK,
               true,
               $this->officerRepository->getOfficerById($officerId),
           );
       } catch (ModelNotFoundException $exception) {
           return ApiResponse::toJson(
               'Data dengan id '.$officerId.' tidak ditemukan',
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
     * Store a newly created officer in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\QueryException
     * @throws \Exception
     */
    public function insertOfficer(OfficerRequest $requestData)
    {
        try {
            return ApiResponse::toJson(
                'Data petugas berhasil ditambahkan',
                201,
                true,
                $this->officerRepository->insertOfficer($requestData->validated()),
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
     * Update the specified officer in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function updateOfficer(OfficerRequest $requestData, string $officerId)
    {
        try {
            return ApiResponse::toJson(
                'Data petugas berhasil diubah',
                Response::HTTP_OK,
                true,
                $this->officerRepository->updateOfficer($requestData->validated(), $officerId),
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data dengan id '.$officerId.' tidak ditemukan',
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
     * Remove the specified officer from storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function deleteOfficer(string $officerId)
    {
        try {
            return ApiResponse::toJson(
                'Data petugas berhasil dihapus',
                Response::HTTP_OK,
                true,
                $this->officerRepository->deleteOfficer($officerId),
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data dengan id '.$officerId.' tidak ditemukan',
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
