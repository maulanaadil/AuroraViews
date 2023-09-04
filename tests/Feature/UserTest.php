<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Tests\TestCase;

class UserTest extends TestCase
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

   public function testGetAllUsers()
   {
       $users = new UserRepository(
           new User()
       );

       $this->authenticate()->getJson('/api/v1/users')->assertJson([
           'message' => 'Data user berhasil diambil',
           'statusCode' => 200,
           'status' => true,
           'data' => $users->getAllUsers()->toArray(),
       ]);
   }

   public function testGetUserById()
   {
       $userId = 1;
       $officers = new UserRepository(
           new User()
       );

       $this->authenticate()->getJson('/api/v1/users/'.$userId)->assertJson([
           'message' => 'Data user berhasil diambil',
           'statusCode' => 200,
           'status' => true,
           'data' => $officers->getUserById($userId)->toArray(),
       ]);
   }

   public function testInserUser()
   {
       $payload = [
           'nama' => 'jenny',
           'username' => uniqid(),
           'password' => 'admin1234',
           'password_confirmation' => 'admin1234',
           'hak' => 'Admin',
       ];

       $response = $this->authenticate()->postJson('/api/v1/users/add', $payload)->assertJson([
           'message' => 'Data user berhasil ditambahkan',
           'statusCode' => 201,
           'status' => true,
       ]);

       $responseData = $response->json();

       $this->assertIsString($responseData['data']['nama']);
       $this->assertIsString($responseData['data']['username']);
       $this->assertIsString($responseData['data']['hak']);
       $this->assertIsString($responseData['data']['updated_at']);
       $this->assertIsString($responseData['data']['created_at']);
       $this->assertIsInt($responseData['data']['id']);
       $this->assertGreaterThan(0, $responseData['data']['id']);
   }

   public function testDeleteUser()
   {
       $user = new UserRepository(
           new User()
       );

       $payload = [
           'nama' => 'jenny',
           'username' => uniqid(),
           'password' => 'admin1234',
           'password_confirmation' => 'admin1234',
           'hak' => 'Admin',
       ];

       $newDataUser = $user->insertUser($payload);

       $newDataUser = $newDataUser->id;

       $this->authenticate()->deleteJson('/api/v1/users/'.$newDataUser.'')->assertJson([
           'message' => 'Data user berhasil dihapus',
           'statusCode' => 200,
           'status' => true,
           'data' => null,
       ]);
   }
}
