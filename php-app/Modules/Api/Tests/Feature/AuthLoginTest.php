<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Modules\Api\Entities\User;
use Tests\TestCase;
use Tymon\JWTAuth\JWTAuth;

class AuthLoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testValidRequestShouldReturnBadRequest(): void
    {
        $response = $this->postJson('/api/v1/login', ['email' => 'nam']);

        $response->assertStatus(422);
    }

    public function testValidRequestShouldReturnSuccess(): void
    {
        $user = User::factory()->state(['password' => Hash::make('12345678')])->create();

        $response = $this->postJson('/api/v1/login', ['email' => $user->email, 'password' => '12345678']);
        $response->assertStatus(200);
    }

    public function testValidTokenShouldReturnSuccess(): void
    {
        $jwtAuth = app(JWTAuth::class);
        $user = User::factory()->state(['password' => Hash::make('12345678')])->create();
        $token = $jwtAuth->fromUser($user);

        $response = $this->getJson('/api/v1/test-auth', ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }

    public function testInvalidTokenShouldReturnSuccess(): void
    {
        User::factory()->state(['password' => Hash::make('12345678')])->create();
        $response = $this->getJson('/api/v1/test-auth', ['Authorization' => 'Bearer asdasdasdasd']);

        $response->assertStatus(401);
    }
}
