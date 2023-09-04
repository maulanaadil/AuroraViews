<?php

namespace Tests\Feature;

use Tests\TestCase;

class UnauthenticatedTest extends TestCase
{
    public function testUnauthenticated()
    {
        $this->getJson('/api/v1/petugas')->assertJson([
            'message' => 'The token could not be parsed from the request',
        ]);
    }
}
