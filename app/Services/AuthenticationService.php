<?php

namespace App\Services;

use App\Repositories\Authentication\AuthenticationRepository;
use App\Request\Authentication\LoginRequest;
use App\Request\Authentication\RegisterRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class AuthenticationService
{
    protected $authenticationRepository;

    public function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    /**
     * Handle login user
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function login(LoginRequest $credentials)
    {
        try {
            $authCredentials = $credentials->validated();

            $authentication = $this->authenticationRepository->login($authCredentials);

            return ApiResponse::toJson(
                'Login berhasil',
                Response::HTTP_OK,
                true,
                $authentication,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Username atau password salah',
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
     * Handle register user
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function register(RegisterRequest $data)
    {
        try {
            $registerData = $data->validated();

            $newUserData = $this->authenticationRepository->register($registerData);

            return ApiResponse::toJson(
                'Registrasi berhasil',
                Response::HTTP_CREATED,
                true,
                $newUserData,
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Registrasi gagal',
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
