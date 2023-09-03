<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReasonTest extends TestCase
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

    public function testGetAllReason()
    {
        $this->authenticate()->getJson('/api/v1/alasan')->assertJson([
            'message' => 'Data alasan berhasil diambil',
            'statusCode' => 200,
            'status' => true,
        ]);
    }

    public function testGetReasonById()
    {
        $reasonId = 37;

        $this->authenticate()->getJson('/api/v1/alasan/'.$reasonId)->assertJson([
            'message' => 'Data alasan berhasil diambil',
            'statusCode' => 200,
            'status' => true,
        ]);
    }

    public function testInsertReason()
    {
        $payload = [
            'alasan' => 'Test Alasan',
        ];

        $response = $this->authenticate()->postJson('/api/v1/alasan/add', $payload)->assertJson([
            'message' => 'Data alasan berhasil ditambahkan',
            'statusCode' => 201,
            'status' => true,
            'data' => [
                'alasan' => $payload['alasan'],
            ],
        ]);

        $responseData = $response->json();
        $reasonId = $responseData['data']['alasan_id'];

        $this->assertIsInt($reasonId);
        $this->assertGreaterThan(0, $reasonId);
    }

    public function testUpdateReason()
    {
        $reasonId = 37;
        $payload = [
            'alasan' => 'Test Alasan Update',
        ];

        $this->authenticate()->postJson('/api/v1/alasan/'.$reasonId.'/update', $payload)->assertJson([
            'message' => 'Data alasan berhasil diubah',
            'statusCode' => 200,
            'status' => true,
            'data' => [
                'alasan' => $payload['alasan'],
            ],
        ]);
    }
}
