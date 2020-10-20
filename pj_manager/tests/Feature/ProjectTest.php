<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Project extends TestCase
{
    use RefreshDatabase;

    public function testAccessProjectIndex()
    {
        $response = $this->get('/project');
        $response->assertStatus(302);
    }

    public function testAccessProjectIndexWithAuth()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/project');
        $response->assertStatus(200);
    }
}
