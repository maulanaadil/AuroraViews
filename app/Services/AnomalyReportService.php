<?php

namespace App\Services;

use App\Repositories\AnomalyReport\AnomalyReportRepository;
use App\Request\AnomalyReport\AnomalyReportRequest;
use App\Request\AnomalyReport\AnomalyReportRequestOnlyPeriod;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class AnomalyReportService
{
    protected $anomalyRepository;

    public function __construct(AnomalyReportRepository $anomalyRepository)
    {
        return $this->anomalyRepository = $anomalyRepository;
    }

    /**
     * Handle get anomaly report that has date diff based on the given period range
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getExportDateDiffReport(AnomalyReportRequest $request)
    {
        try {
            return ApiResponse::toJson(
                'Data anomali berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $this->anomalyRepository->getExportDateDiffReport($request->validated())
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data anomali tidak ditemukan',
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
      * Handle get anomaly report water usage based on the given period range
      *
      * @return \Illuminate\Http\Response
      *
      * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
      * @throws \Exception
      */
     public function getExportWaterUsage(AnomalyReportRequest $request)
     {
         try {
             return ApiResponse::toJson(
                 'Data anomali berhasil ditemukan',
                 Response::HTTP_OK,
                 true,
                 $this->anomalyRepository->getExportWaterUsage($request->validated()),
             );
         } catch (ModelNotFoundException $exception) {
             return ApiResponse::toJson(
                 'Data anomali tidak ditemukan',
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
     * Handle get anomaly report equal water usage based on the given period range
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getExportEqualWaterUsage(AnomalyReportRequestOnlyPeriod $request)
    {
        try {
            return ApiResponse::toJson(
                'Data anomali berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $this->anomalyRepository->getExportEqualWaterUsage($request->validated()),
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data anomali tidak ditemukan',
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
     * Handle get anomaly report of more water usage based on the given period range
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getExportOfMoreWaterUsage(AnomalyReportRequest $request)
    {
        try {
            return ApiResponse::toJson(
                'Data anomali berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $this->anomalyRepository->getExportOfMoreWaterUsage($request->validated()),
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data anomali tidak ditemukan',
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
