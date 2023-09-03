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
}
