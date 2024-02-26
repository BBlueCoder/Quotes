<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\assertSame;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        $user = User::factory()->make();

        $response = $this->post('/user/create', [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function testCreateUserWithProfilePic()
    {
        $user = User::factory()->make();

        $profilePic = UploadedFile::fake()->image('profile_pic.jpg');

        $response = $this->post('/user/create', [
            'username' => $user->username,
            'email' => $user->email,
            'profile-pic' => $profilePic,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(200);

        $this->assertTrue(file_exists(storage_path('app/public/profile_pics/' . $profilePic->hashName())));
    }

    public function testCreateUserWithDuplicateUsername()
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

    public function testCreateUserWithDuplicateEmail()
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

    public function testCreateUserWithShortPassword()
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

    public function testCreateUserWithUnmatchedPasswords()
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

    public function testCreateUserWithInvalidData()
    {

        //empty data
        $response = $this->post('/user/create', []);

        $response->assertStatus(302);

        // invalid username
        $user = User::factory()->make();

        $response = $this->post('/user/create', [
            'username' => 12345,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response->assertStatus(302);

        // invalid email
        $user = User::factory()->make();

        $response = $this->post('/user/create', [
            'username' => $user->username,
            'email' => "invalid_email",
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response->assertStatus(302);
    }

    public function testLogin()
    {
        $user = User::factory()->create();

        $response = $this->post('/user/authenticate', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function testLoginWithInvalidData()
    {
        // without email
        $response = $this->post('/user/authenticate', [
            'password' => 'password',
        ]);

        $response->assertStatus(302);

        // with invalid email
        $response = $this->post('/user/authenticate', [
            'email' => 'invalid',
            'password' => 'password',
        ]);

        $response->assertStatus(302);

        // without password
        $response = $this->post('/user/authenticate', [
            'email' => 'user@email.com',
        ]);

        $response->assertStatus(302);
    }

    public function testLoginWithIncorrectEmail()
    {
        $response = $this->post('/user/authenticate', [
            'email' => 'user@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(302);
    }

    public function testLoginWithIncorrectPassword()
    {
        $user = User::factory()->create();

        $response = $this->post('/user/authenticate', [
            'email' => $user->email,
            'password' => 'incorrectpassword',
        ]);

        $response->assertStatus(302);
    }
}
