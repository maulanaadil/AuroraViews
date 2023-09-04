<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * Test login as admin
     */
    public function testLogin()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'username' => 'admin',
            'password' => 'admin123',
        ]);
        $response->assertJson(
            [
                'message' => 'Login berhasil',
                'statusCode' => 200,
                'status' => true,
            ]
        );
    }

    /**
     * Test failed login with wrong password
     */
    public function testFailedLoginWithWrongUsername()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'username' => 'admin123',
            'password' => 'admin1234',
        ]);
        $response->assertJson(
            [
                'message' => 'Username tidak ditemukan',
                'statusCode' => 404,
                'status' => false,
            ]
        );
    }

    /**
     * Test failed login with wrong password
     */
    public function testFailedLoginWithWrongPassword()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'username' => 'testing',
            'password' => 'admin1234asdasdsadsa',
        ]);
        $response->assertJson(
            [
                'message' => 'Username atau password salah',
                'statusCode' => 401,
                'status' => false,
            ]
        );
    }

    /**
     * Test register become admin
     */
    public function testRegister()
    {
        $payload = [
            'nama' => 'Natasya',
            'username' => uniqid(),
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
            'hak' => 'admin',
        ];

        $response = $this->postJson('/api/v1/auth/register', $payload);

        $response->assertJson(
            [
                'message' => 'Registrasi berhasil',
                'statusCode' => 201,
                'status' => true,
                'data' => [
                    'nama' => $payload['nama'],
                    'username' => $payload['username'],
                    'hak' => $payload['hak'],
                ],
            ]
        );
    }

    /**
     * Test failed register with password confirmation not match
     */
    public function testFailedRegisterWithPasswordConfirmationNotMatch()
    {
        $payload = [
            'nama' => 'Natasya',
            'username' => uniqid(),
            'password' => 'admin123',
            'password_confirmation' => 'admin1234',
            'hak' => 'admin',
        ];

        $response = $this->postJson('/api/v1/auth/register', $payload);

        $response->assertJson(
            [
                'message' => 'The password confirmation does not match.',
                'errors' => [
                    'password' => [
                        'The password confirmation does not match.',
                    ],
                ],
            ]
        );
    }

    /**
     * Test failed register if username already exist
     */
    public function testFailedRegisterIfUsernameAlreadyExist()
    {
        $payload = [
            'nama' => 'Natasya',
            'username' => 'admin',
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
            'hak' => 'admin',
        ];

        $response = $this->postJson('/api/v1/auth/register', $payload);

        $response->assertJson(
            [
                'message' => 'The username has already been taken.',
                'errors' => [
                    'username' => [
                        'The username has already been taken.',
                    ],
                ],
            ]
        );
    }
}
