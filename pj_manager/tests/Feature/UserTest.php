<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    public function testAccessLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testAccessRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
