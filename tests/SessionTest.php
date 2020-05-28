<?php

namespace Javleds\Traccar\Tests;

use Javleds\Traccar\Session;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class SessionTest extends TestCase
{
    public function testCreateSession()
    {
        $client = HttpClient::create();
        $response = $client->request('POST', 'http://localhost:8082/api/session', [
            'body' => [
                'email' => 'admin',
                'password' => 'admin'
            ]
        ]);

        $decoded = json_decode($response->getContent(),true);
        $this->assertJson($response->getContent());

        $this->assertArrayHasKey('id', $decoded);
        $this->assertArrayHasKey('name', $decoded);
        $this->assertArrayHasKey('email', $decoded);
    }
}
