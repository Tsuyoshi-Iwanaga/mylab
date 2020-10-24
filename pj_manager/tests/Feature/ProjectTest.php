<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Project extends TestCase
{
    use RefreshDatabase;

    public function getPostData() {
        return [
            'jobCode' => '1234567890',
            'name' => 'キャンペーンLP作成',
            'period_id' => 1,
            'group_id' => 1,
            'client_id' => 2,
            'branch_id' => 1,
            'status_id' => 1,
            'director' => '田中 太郎',
            'director_email' => 'tanaka001@test.com',
            'assigner' => '森永 秀太',
            'note' => '福岡アサイン希望',
        ];
    }

    public function testAccessProjectIndexWithoutAuth()
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

    public function testPostProjectCreate()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->post('/project', $this->getPostData());
        $response->assertRedirect('/project');
    }

    public function testPostProjectCreateWithoutAuth()
    {
        $response = $this->post('/project', $this->getPostData());
        $response->assertRedirect('/login');
    }

    public function testPostProjectCreateWithoutjobCode()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['jobCode']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['jobCode']);
    }

    public function testPostProjectCreateWithoutName()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['name']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['name']);
    }

    public function testPostProjectCreateWithoutPeriodId()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['period_id']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['period_id']);
    }

    public function testPostProjectCreateWithoutGroupId()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['group_id']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['group_id']);
    }

    public function testPostProjectCreateWithoutClientId()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['client_id']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['client_id']);
    }

    public function testPostProjectCreateWithoutBranchId()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['branch_id']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['branch_id']);
    }

    public function testPostProjectCreateWithoutStatusId()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['status_id']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['status_id']);
    }

    public function testPostProjectCreateWithoutDirector()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['director']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['director']);
    }

    public function testPostProjectCreateWithoutDirectorEmail()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['director_email']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['director_email']);
    }

    public function testPostProjectCreateWithoutAsigner()
    {
        $user = factory(\App\User::class)->create();
        $data = $this->getPostData();
        unset($data['assigner']);
        $response = $this->actingAs($user)->post('/project', $data);
        $response->assertSessionHasErrors(['assigner']);
    }
}
