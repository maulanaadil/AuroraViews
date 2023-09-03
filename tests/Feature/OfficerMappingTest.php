<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\MWriter;
use App\Models\MWriterArea;
use App\Models\Regional;
use App\Repositories\Block\BlockRepository;
use App\Repositories\Officer\OfficerMappingRepository;
use App\Repositories\Regional\RegionalRepository;
use Tests\TestCase;

class OfficerMappingTest extends TestCase
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

    public function testGetSelectedRegionalById()
    {
        $regional = new RegionalRepository(
            new Regional()
        );
        $regionalId = 7;

        $this->authenticate()->getJson('/api/v1/pemetaan_petugas/select_regional/'.$regionalId.'')->assertJson([
            'message' => 'Data regional berhasil diambil',
            'statusCode' => 200,
            'status' => true,
            'data' => $regional->getSelectedRegionalById($regionalId)->toArray(),
        ]);
    }

    public function testGetSelectedBlockById()
    {
        $block = new BlockRepository(
            new Block()
        );
        $params = [
            'block_id' => '1201',
        ];
        $response = $this->authenticate()->json('GET', '/api/v1/pemetaan_petugas/select_blocks', $params);

        $response->assertJson(
            [
                'message' => 'Data block berhasil diambil',
                'statusCode' => 200,
                'status' => true,
                'data' => $block->getSelectedBlocksById($params['block_id'])->toArray(),
            ]
        );
    }

    public function testGetAreaByOfficerById()
    {
        $params = [
            'petugas_id' => '33',
        ];
        $response = $this->authenticate()->json('GET', '/api/v1/pemetaan_petugas/area_petugas', $params);

        $response->assertJson(
            [
                'message' => 'Data block berhasil diambil',
                'statusCode' => 200,
                'status' => true,
            ]
        );
    }

    public function testInsertMappingOfficer()
    {
        $payload = [
            'writer_id' => 33,
            'block_id' => 1077,
            'rgn_id' => 71,
            'of_id' => 14,
            'tgl_download' => 5,
            'tgl_max_upload' => 30,
        ];

        $response = $this->authenticate()->postJson('/api/v1/pemetaan_petugas/add', $payload)->assertJson([
            'message' => 'Data berhasil ditambahkan',
            'statusCode' => 201,
            'status' => true,
        ]);

        $responseData = $response->json();

        $this->assertIsInt($responseData['data']['writer_id']);
        $this->assertIsInt($responseData['data']['block_id']);
        $this->assertIsInt($responseData['data']['rgn_id']);
        $this->assertIsInt($responseData['data']['of_id']);
        $this->assertIsInt($responseData['data']['tgl_download']);
        $this->assertIsInt($responseData['data']['tgl_max_upload']);
        $this->assertIsInt($responseData['data']['wr_area_id']);
    }

    public function testDeleteMappingOfficer()
    {
        $officerMapping = new OfficerMappingRepository(
            new MWriter(),
            new MWriterArea()
        );

        $payload = [
            'writer_id' => 33,
            'block_id' => 1077,
            'rgn_id' => 71,
            'of_id' => 14,
            'tgl_download' => 5,
            'tgl_max_upload' => 30,
        ];

        $newDataOfficerMapping = $officerMapping->insertMappingOfficer($payload);

        $newDataOfficerMapping = $newDataOfficerMapping->wr_area_id;

        $this->authenticate()->deleteJson('/api/v1/pemetaan_petugas/'.$newDataOfficerMapping.'')->assertJson([
            'message' => 'Data pemetaan petugas berhasil dihapus',
            'statusCode' => 200,
            'status' => true,
            'data' => null,
        ]);
    }
}
