<?php

namespace Tests\Feature;

use Tests\TestCase;

class RecordAnalyticsTest extends TestCase
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

    public function testGetRecordProgress()
    {
        $params = [
            'id_cabang' => 3,
            'periode' => '2022-09-15',
            'tanggal_awal' => '2022-09-15',
            'tanggal_akhir' => '2022-09-20',
            'id_hak' => '2',
        ];

        $response = $this->authenticate()->json('GET', '/api/v1/pencatatan/record', $params);

        $response->assertJson(
            [
                'message' => 'Data berhasil diambil',
                'statusCode' => 200,
                'status' => true,
            ]
        );
    }

    public function testGetOfficeProgres()
    {
        $params = [
            'id_cabang' => 3,
            'periode' => '2022-09-15',
            'id_hak' => '1',
            'tanggal_awal' => '2022-09-15',
            'tanggal_akhir' => '2022-09-20',
        ];

        $response = $this->authenticate()->json('GET', '/api/v1/pencatatan/record', $params);

        $response->assertJson(
            [
                'message' => 'Data berhasil diambil',
                'statusCode' => 200,
                'status' => true,
            ]
        );
    }
}
