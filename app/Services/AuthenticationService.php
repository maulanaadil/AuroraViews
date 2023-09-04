<?php

namespace App\Services;

use App\Repositories\Authentication\AuthenticationRepository;
use App\Repositories\User\UserRepository;
use App\Request\Authentication\LoginRequest;
use App\Request\Authentication\RegisterRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    protected $authenticationRepository;

    protected $userRepository;

    public function __construct(AuthenticationRepository $authenticationRepository, UserRepository $userRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
        $this->userRepository = $userRepository;
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
            // Validate the input credentials using the LoginRequest class
            $validatedCredentials = $credentials->validated();

            // Find the user by their username
            $user = $this->userRepository->getUserByUsername($validatedCredentials['username']);

            // Check if the provided password is correct
            if (Hash::check($validatedCredentials['password'], $user->password) === false) {
                return ApiResponse::toJson(
                    'Username atau password salah',
                    Response::HTTP_UNAUTHORIZED,
                    false,
                    null
                );
            }

            // If the password is correct, perform the login and return a success response
            $authentication = $this->authenticationRepository->login($validatedCredentials);

            return ApiResponse::toJson(
                'Login berhasil',
                Response::HTTP_OK,
                true,
                $authentication
            );
        } catch (ModelNotFoundException $exception) {
            return ApiResponse::toJson(
                'Username tidak ditemukan',
                Response::HTTP_NOT_FOUND,
                false,
                null
            );
        } catch (Exception $exception) {
            return ApiResponse::toJson(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                false,
                null
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
