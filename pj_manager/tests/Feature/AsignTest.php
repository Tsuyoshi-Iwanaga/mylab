<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AsignTest extends TestCase
{
    use RefreshDatabase;

    public function testAccessAsignIndex()
    {
        $response = $this->get('/asign');
        $response->assertStatus(302);
    }

    public function testAccessAsignIndexWithAuth()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/asign');
        $response->assertStatus(200);
    }
}
