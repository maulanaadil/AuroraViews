<?php

namespace App\Services;

use App\Repositories\Authorization\AuthorizationRepository;
use App\Request\AuthorizationRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class AuthorizationService
{
    private $authorizationRepository;

    public function __construct(AuthorizationRepository $authorizationRepository)
    {
        $this->authorizationRepository = $authorizationRepository;
    }

    /**
     * Display a listing of the authorization.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\QueryException
     * @throws \Exception
     */
    public function getAllAuthorization()
    {
        try {
            $authorizations = $this->authorizationRepository->getAllAuthorization();

            return ApiResponse::toJson(
                'Data hak berhasil diambil',
                Response::HTTP_OK,
                true,
                $authorizations,
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
     * Display the specified authorization.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getAuthorizationById(string $authorizationId)
    {
        try {
            $authorization = $this->authorizationRepository->getAuthorizationById($authorizationId);

            return ApiResponse::toJson(
                'Data hak berhasil diambil',
                Response::HTTP_OK,
                true,
                $authorization,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data hak tidak ditemukan',
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
     * Store a newly created authorization in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function insertAuthorization(AuthorizationRequest $requestData)
    {
        try {
            $newDataAuthorization = $requestData->validated();
            $authorization = $this->authorizationRepository->insertAuthorization($newDataAuthorization);

            return ApiResponse::toJson(
                'Data hak berhasil ditambahkan',
                Response::HTTP_CREATED,
                true,
                $authorization,
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
     * Remove the specified authorization from storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function deleteAuthorization(string $authorizationId)
    {
        try {
            $authorization = $this->authorizationRepository->deleteAuthorization($authorizationId);

            return ApiResponse::toJson(
                'Data hak berhasil dihapus',
                Response::HTTP_OK,
                true,
                $authorization,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data hak tidak ditemukan',
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
