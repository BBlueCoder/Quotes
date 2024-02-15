<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesUserTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $user = User::factory()->make();

        $this->post('/user/create', [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function testCreateWithDuplicateUsername()
    {
        $user = User::factory()->create();

        $response = $this->post('/user/create', [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(302);
    }

    public function testCreateWithDuplicateEmail()
    {
        $user = User::factory()->create();

        $response = $this->post('/user/create', [
            'username' => "user123",
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(302);
    }

    public function testCreateWithShortPassword()
    {
        $user = User::factory()->make();

        $response = $this->post('/user/create', [
            'username' => $user->username,
            'email' => $user->email,
            'password' => '1234',
            'password_confirmation' => '1234'
        ]);

        $response->assertStatus(302);
    }

    public function testCreateWithUnmatchedPasswords()
    {
        $user = User::factory()->make();

        $response = $this->post('/user/create', [
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password . '1'
        ]);

        $response->assertStatus(302);
    }
}
