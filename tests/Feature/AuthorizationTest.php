<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    private function authenticate()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $token = $response['data'];

        return $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ]);
    }

    public function testGetAllAuthorization()
    {
        return $this->authenticate()->getJson('/api/v1/otorisasi')->assertJson([
            'message' => 'Data hak berhasil diambil',
            'statusCode' => 200,
            'status' => true,
        ]);
    }

    public function testInsertAuthorization()
    {
        $payload = [
            'nama_hak' => 'kucing',
        ];

        $response = $this->authenticate()->postJson('/api/v1/otorisasi/add', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Data hak berhasil ditambahkan',
                'statusCode' => 201,
                'status' => true,
                'data' => [
                    'nama_hak' => $payload['nama_hak'],
                ],
            ]);

        $responseData = $response->json();
        $authorizationId = $responseData['data']['id'];

        $this->assertIsInt($authorizationId);
        $this->assertGreaterThan(0, $authorizationId);
    }

    public function testDeleteAuthorization()
    {
        $reasonId = 6;

        $this->authenticate()->deleteJson('/api/v1/otorisasi/'.$reasonId)->assertJson([
            'message' => 'Data hak tidak ditemukan',
            'statusCode' => 404,
            'status' => false,
            'data' => null,
        ]);
    }
}
