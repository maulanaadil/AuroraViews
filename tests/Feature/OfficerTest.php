<?php

namespace Tests\Feature;

use App\Models\MWriter;
use App\Repositories\Officer\OfficerRepository;
use Tests\TestCase;

class OfficerTest extends TestCase
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

    public function testGetAllOfficers()
    {
        $officers = new OfficerRepository(
            new MWriter()
        );

        $this->authenticate()->getJson('/api/v1/petugas')->assertJson([
            'message' => 'Data petugas berhasil diambil',
            'statusCode' => 200,
            'status' => true,
            'data' => $officers->getAllOfficer()->toArray(),
        ]);
    }

   public function testGetOfficerById()
   {
       $officerId = 89;
       $officers = new OfficerRepository(
           new MWriter()
       );

       $this->authenticate()->getJson('/api/v1/petugas/'.$officerId)->assertJson([
           'message' => 'Data petugas berhasil diambil',
           'statusCode' => 200,
           'status' => true,
           'data' => $officers->getOfficerById($officerId)->toArray(),
       ]);
   }

   public function testInsertOfficer()
   {
       $payload = [
           'writer_name' => 'Natasya',
           'notelp' => '082116765513',
           'alamat' => 'Jln Jatinangor',
           'writer_user_name' => uniqid(),
           'password' => 'blackpink123',
       ];

       $response = $this->authenticate()->postJson('/api/v1/petugas/add', $payload)->assertJson([
           'message' => 'Data petugas berhasil ditambahkan',
           'statusCode' => 201,
           'status' => true,
       ]);

       $responseData = $response->json();

       $this->assertIsString($responseData['data']['writer_name']);
       $this->assertIsString($responseData['data']['alamat']);
       $this->assertIsString($responseData['data']['writer_user_name']);
       $this->assertIsInt($responseData['data']['writer_id']);
       $this->assertGreaterThan(0, $responseData['data']['writer_id']);
   }

   public function testUpdateOfficer()
   {
       $payload = [
           'writer_name' => 'Abigail',
           'notelp' => '082116765513',
           'alamat' => 'Jln Jatinangor',
           'writer_user_name' => uniqid(),
           'password' => 'blackpink123',
       ];

       $officerId = 172;

       $response = $this->authenticate()->postJson('/api/v1/petugas/'.$officerId.'/update', $payload)->assertJson([
           'message' => 'Data petugas berhasil diubah',
           'statusCode' => 200,
           'status' => true,
       ]);

       $responseData = $response->json();

       $this->assertIsString($responseData['data']['writer_name']);
       $this->assertIsString($responseData['data']['alamat']);
       $this->assertIsString($responseData['data']['writer_user_name']);
       $this->assertIsInt($responseData['data']['writer_id']);
       $this->assertGreaterThan(0, $responseData['data']['writer_id']);
   }

   public function testDeleteOfficer()
   {
       $officers = new OfficerRepository(
           new MWriter()
       );

       $payload = [
           'writer_name' => 'Natasya',
           'notelp' => '082116765513',
           'alamat' => 'Jln Jatinangor',
           'writer_user_name' => uniqid(),
           'password' => 'blackpink123',
       ];

       $newDataOfficer = $officers->insertOfficer($payload);

       $newDataOfficer = $newDataOfficer->writer_id;

       $this->authenticate()->deleteJson('/api/v1/petugas/'.$newDataOfficer.'')->assertJson([
           'message' => 'Data petugas berhasil dihapus',
           'statusCode' => 200,
           'status' => true,
       ]);
   }
}
