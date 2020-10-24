<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function testAccessClientIndex()
    {
        $response = $this->get('/client');
        $response->assertStatus(302);
    }

    public function testAccessClientIndexWithAuth()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/client');
        $response->assertStatus(200);
    }
}
