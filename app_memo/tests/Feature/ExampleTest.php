<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testAccessTop()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testAccessHome()
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function testAccessTodoIndex()
    {
        $response = $this->get('/todo');
        $response->assertStatus(200);
    }

    public function testAccessMemoIndex()
    {
        $response = $this->get('/todo');
        $response->assertStatus(200);
    }
}
