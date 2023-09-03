<?php

namespace Tests\Feature;

use App\Repositories\AnomalyReport\AnomalyReportRepository;
use Tests\TestCase;

class AnomalyReportTest extends TestCase
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

    public function testGetExportDateDiffReport()
    {
        $params = [
            'office_id' => 2,
            'periode' => '2022-09-28',
            'regional_id' => 1,
            'block_id' => 950,
        ];
        $anomalyReports = new AnomalyReportRepository();

        $response = $this->authenticate()->json('GET', '/api/v1/laporan_anomali/export_laporan_selisih_tgl', $params);

        $response->assertJson(
            [
                'message' => 'Data anomali berhasil ditemukan',
                'statusCode' => 200,
                'status' => true,
                'data' => $anomalyReports->getExportDateDiffReport($params),
            ]
        );
    }

    public function testGetExportWaterUsage()
    {
        $params = [
            'office_id' => 2,
            'periode' => '2022-09-28',
            'regional_id' => 1,
            'block_id' => 950,
        ];
        $anomalyReports = new AnomalyReportRepository();

        $response = $this->authenticate()->json('GET', '/api/v1/laporan_anomali/export_laporan_pemakaian', $params);

        $response->assertJson(
            [
                'message' => 'Data anomali berhasil ditemukan',
                'statusCode' => 200,
                'status' => true,
                'data' => $anomalyReports->getExportWaterUsage($params),
            ]
        );
    }

    public function testGetExportEqualWaterUsage()
    {
        $params = [
            'periode' => '2022-09-15',
        ];

        $anomalyReports = new AnomalyReportRepository();

        $response = $this->authenticate()->json('GET', '/api/v1/laporan_anomali/export_laporan_pemakaian_sama', $params);

        $response->assertJson(
            [
                'message' => 'Data anomali berhasil ditemukan',
                'statusCode' => 200,
                'status' => true,
                'data' => $anomalyReports->getExportEqualWaterUsage($params),
            ]
        );
    }

    public function testGetExportOfMoreWaterUsage()
    {
        $params = [
            'office_id' => 2,
            'periode' => '2022-09-28',
            'regional_id' => 1,
            'block_id' => 950,
        ];

        $anomalyReports = new AnomalyReportRepository();

        $response = $this->authenticate()->json('GET', '/api/v1/laporan_anomali/export_laporan_lebih_tgl', $params);

        $response->assertJson(
            [
                'message' => 'Data anomali berhasil ditemukan',
                'statusCode' => 200,
                'status' => true,
                'data' => $anomalyReports->getExportOfMoreWaterUsage($params),
            ]
        );
    }
}
