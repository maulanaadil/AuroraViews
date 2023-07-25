<?php

namespace App\Services;

use App\Repositories\Dashboard\DashboardRepository;
use App\Request\DashboardRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class DashboardService
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Handle get analytics officers
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getAnalyticsOfficers(DashboardRequest $request)
    {
        try {
            $payload = $request->validated();
            $data = $this->dashboardRepository->getAnalyticsOfficers($payload);

            return ApiResponse::toJson(
                'Data berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $data,
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
     * Handle get analytics costs
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getAnalyticsCosts(DashboardRequest $request)
    {
        try {
            $payload = $request->validated();
            $data = $this->dashboardRepository->getAnalyticsCosts($payload);

            return ApiResponse::toJson(
                'Data berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $data,
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
     * Handle get analytics records
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getAnalyticsRecords(DashboardRequest $request)
    {
        try {
            $payload = $request->validated();
            $data = $this->dashboardRepository->getAnalyticsRecords($payload);

            return ApiResponse::toJson(
                'Data berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $data,
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
