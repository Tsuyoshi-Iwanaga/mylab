<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testAccessHomeIndex()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }

    public function testAccessHomeIndexWithAuth()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
    }
}
