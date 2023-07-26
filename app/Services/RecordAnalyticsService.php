<?php

namespace App\Services;

use App\Repositories\RecordAnalytics\RecordAnalyticsRepository;
use App\Request\RecordAnalytics\RecordOfficeProgressAnalyticsRequest;
use App\Request\RecordAnalytics\RecordProgressAnalyticsRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class RecordAnalyticsService
{
    protected $recordAnalyticsRepository;

    public function __construct(RecordAnalyticsRepository $recordAnalyticsRepository)
    {
        $this->recordAnalyticsRepository = $recordAnalyticsRepository;
    }

     /**
      * Display all record progress data based on period and office
      *
      * @return  \Illuminate\Http\Response
      *
      * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
      * @throws \Exception
      */
     public function getRecordProgress(RecordProgressAnalyticsRequest $request)
     {
         try {
             $isAuthorizeHublang = $request->id_hak == 2;

             //  if the id_hak is 2, then the user is hublang
             if ($isAuthorizeHublang) {
                 $recordHublangProgress = $this->recordAnalyticsRepository->getHublangRecordProgress($request->validated());

                 return ApiResponse::toJson(
                     'Data berhasil diambil',
                     Response::HTTP_OK,
                     true,
                     $recordHublangProgress,
                 );
             }

             //  if the id_hak is not 2, then the user is not hublang
             $recordProgress = $this->recordAnalyticsRepository->getRecordProgress($request->validated());

             return ApiResponse::toJson(
                 'Data berhasil diambil',
                 Response::HTTP_OK,
                 true,
                 $recordProgress,
             );
         } catch (ModelNotFoundException $exception) {
             return ApiResponse::toJson(
                 'Data tidak ditemukan',
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
      * Display all office progress data based on period and office
      *
      * @return  \Illuminate\Http\Response
      *
      * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
      * @throws \Exception
      */
     public function getOfficeProgress(RecordOfficeProgressAnalyticsRequest $request)
     {
         try {
             $isAuthorizeHublang = $request->id_hak == 2;

             //  if the id_hak is 2, then the user is hublang
             if ($isAuthorizeHublang) {
                 $recordHublangOfficeProgress = $this->recordAnalyticsRepository->getHublangOfficeProgress($request->validated());

                 return ApiResponse::toJson(
                     'Data berhasil diambil',
                     Response::HTTP_OK,
                     true,
                     $recordHublangOfficeProgress,
                 );
             }

             //  if the id_hak is not 2, then the user is not hublang
             $recordOfficeProgress = $this->recordAnalyticsRepository->getOfficeProgress($request->validated());

             return ApiResponse::toJson(
                 'Data berhasil diambil',
                 Response::HTTP_OK,
                 true,
                 $recordOfficeProgress,
             );
         } catch (ModelNotFoundException $exception) {
             return ApiResponse::toJson(
                 'Data tidak ditemukan',
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
