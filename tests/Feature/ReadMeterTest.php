<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReadMeterTest extends TestCase
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

     public function testGetReadMeter()
     {
         $params = [
             'office_id' => 1,
         ];

         $response = $this->authenticate()->json('GET', '/api/v1/baca_meter', $params);

         $response->assertJson(
             [
                 'message' => 'Data berhasil ditemukan',
                 'statusCode' => 200,
                 'status' => true,
             ]
         );
     }

     public function testGetInfoCustomer()
     {
         $params = [
             'limit' => 1,
         ];

         $response = $this->authenticate()->json('GET', '/api/v1/baca_meter/info_pelanggan', $params);

         $response->assertJson(
             [
                 'message' => 'Data berhasil ditemukan',
                 'statusCode' => 200,
                 'status' => true,
             ]
         );
     }

     public function testGetPosition()
     {
         $params = [
             'customer_code' => '0101001002',
             'bill_mergeym' => 202209,
         ];

         $response = $this->authenticate()->json('GET', '/api/v1/baca_meter/longlat_pelanggan', $params);

         $response->assertJson(
             [
                 'message' => 'Data berhasil ditemukan',
                 'statusCode' => 200,
                 'status' => true,
             ]
         );
     }
}
