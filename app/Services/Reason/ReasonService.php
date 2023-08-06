<?php

namespace App\Services\Reason;

use App\Repositories\Reason\ReasonRepositoryInterface;
use App\Request\ReasonRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class ReasonService extends AbstractReasonService
{
    protected $reasonRepository;

    public function __construct(ReasonRepositoryInterface $reasonRepository)
    {
        $this->reasonRepository = $reasonRepository;
    }

    /**
     * Display a listing of the reason.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\QueryException
     * @throws \Exception
     */
    public function getAllReason()
    {
        try {
            $reasons = $this->reasonRepository->getAllReason();

            return ApiResponse::toJson(
                'Data alasan berhasil diambil',
                Response::HTTP_OK,
                true,
                $reasons,
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
     * Display the specified reason.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getReasonById(string $reasonId)
    {
        try {
            $reason = $this->reasonRepository->getReasonById($reasonId);

            return ApiResponse::toJson(
                'Data alasan berhasil diambil',
                Response::HTTP_OK,
                true,
                $reason,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data dengan id '.$reasonId.' tidak ditemukan',
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
     * Store a newly created reason in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\QueryException
     * @throws \Exception
     */
    public function insertReason(ReasonRequest $requestData)
    {
        try {
            $reason = $this->reasonRepository->insertReason($requestData->validated());

            return ApiResponse::toJson(
                'Data alasan berhasil ditambahkan',
                201,
                true,
                $reason,
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
     * Update the specified reason in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function updateReason(ReasonRequest $requestData, string $reasonId)
    {
        try {
            $reason = $this->reasonRepository->updateReason($requestData->validated(), $reasonId);

            return ApiResponse::toJson(
                'Data alasan berhasil diubah',
                Response::HTTP_OK,
                true,
                $reason,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data dengan id '.$reasonId.' tidak ditemukan',
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
