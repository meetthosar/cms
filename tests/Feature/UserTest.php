<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Successful Login
     * @test
     * @return void
     */
    public function check_user_successful_login_endpoint()
    {
        $response = $this->postJson('/api/login', ['email' => 'meetthosar@gmail.com', 'password' => base64_encode('meet@123')]);

        $response
            ->assertStatus(200);
    }

    /**
     * Unsuccessful Login
     * @test
     */
    public function check_user_unsuccessful_login_endpoint()
    {
        $response = $this->postJson('/api/login', ['email' => 'meetthosar@gmail.com', 'password' => base64_encode('meet1@123')]);

        $response
            ->assertStatus(401)
            ->assertJson(['error'=>'Unauthorised! Incorrect username or password.']);
    }
}
