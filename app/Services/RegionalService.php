<?php

namespace App\Services;

use App\Repositories\Regional\RegionalRepository;
use App\Request\Regional\SelectRegionalByIdRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Http\Response;

class RegionalService
{
    protected $regionalRepository;

    public function __construct(RegionalRepository $regionalRepository)
    {
        $this->regionalRepository = $regionalRepository;
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
               $this->regionalRepository->getSelectedRegionalById($request->validated()),
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
