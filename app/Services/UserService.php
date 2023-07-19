<?php

namespace App\Services;

use App\Repositories\User\UserRepository;
use App\Request\UserRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\QueryException
     * @throws \Exception
     */
    public function getAllUsers()
    {
        try {
            $users = $this->userRepository->getAllUsers();

            return ApiResponse::toJson(
                'Data user berhasil diambil',
                Response::HTTP_OK,
                true,
                $users,
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
     * Display the specified user.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getUserById(string $userId)
    {
        try {
            $user = $this->userRepository->getUserById($userId);

            return ApiResponse::toJson(
                'Data user berhasil diambil',
                Response::HTTP_OK,
                true,
                $user,
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
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function insertUser(UserRequest $request)
    {
        try {
            $user = $this->userRepository->insertUser($request->validated());

            return ApiResponse::toJson(
                'Data user berhasil ditambahkan',
                Response::HTTP_CREATED,
                true,
                $user,
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
     * Remove the specified user from storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function deleteUser(string $userId)
    {
        try {
            $this->userRepository->deleteUser($userId);

            return ApiResponse::toJson(
                'Data user berhasil dihapus',
                Response::HTTP_OK,
                true,
                null,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Data dengan id '.$userId.' tidak ditemukan',
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
