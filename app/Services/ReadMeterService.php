<?php

namespace App\Services;

use App\Repositories\ReadMeter\ReadMeterRepository;
use App\Request\ReadMeter\FormGetPositionCustomerRequest;
use App\Request\ReadMeter\FormReadMeterRequest;
use App\Request\ReadMeter\LimitGetInfoCustomerRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class ReadMeterService
{
    protected $readMeterRepository;

    public function __construct(ReadMeterRepository $readMeterRepository)
    {
        $this->readMeterRepository = $readMeterRepository;
    }

    /**
     * Handle get read meter data by office id
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getReadMeter(FormReadMeterRequest $request)
    {
        try {
            return ApiResponse::toJson(
                'Data berhasil ditemukan',
                Response::HTTP_OK,
                true,
                [
                    'rates_meter' => $this->readMeterRepository->loadRatesMeter(),
                    'offices' => $this->readMeterRepository->getOfficeById($request->validated()['office_id']),
                ],
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
     * Handle get info customer and limit the result by limit
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getInfoCustomer(LimitGetInfoCustomerRequest $request)
    {
        try {
            return ApiResponse::toJson(
                'Data berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $this->readMeterRepository->getInfoCustomer($request->validated()['limit']),
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
     * Handle get info position customer by customer code and bill mergeym
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getPositionCustomer(FormGetPositionCustomerRequest $request)
    {
        try {
            return ApiResponse::toJson(
                'Data berhasil ditemukan',
                Response::HTTP_OK,
                true,
                $this->readMeterRepository->getPositionCustomer($request->validated()),
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
