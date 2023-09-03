<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
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

    public function testGetanalyticsOfficers()
    {
        $params = [
            'date' => '2021-07-15',
            'office_id' => 1,
        ];
        $response = $this->authenticate()->json('GET', '/api/v1/dashboard/analytics', $params);

        $response->assertJson(
            [
                'message' => 'Data berhasil ditemukan',
                'statusCode' => 200,
                'status' => true,
                'data' => [],
            ]
        );
    }

    public function testGetAnalyticsCost()
    {
        $params = [
            'date' => '2021-09-15',
            'office_id' => 1,
        ];
        $response = $this->authenticate()->json('GET', '/api/v1/dashboard/analytics_price', $params);

        $response->assertJson(
            [
                'message' => 'Data berhasil ditemukan',
                'statusCode' => 200,
                'status' => true,
            ]
        );
    }

    public function testGetAnalyticsRecords()
    {
        $params = [
            'date' => '2021-09-15',
            'office_id' => 1,
        ];
        $response = $this->authenticate()->json('GET', '/api/v1/dashboard/analytics_pencatatan', $params);

        $response->assertJson(
            [
                'message' => 'Data berhasil ditemukan',
                'statusCode' => 200,
                'status' => true,
                'data' => [],
            ]
        );
    }
}
