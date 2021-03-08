<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    /** @test **/
    public function user_can_register(): void
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => $this->faker->name,
            'email' => $email = $this->faker->email,
            'password' => $this->faker->password,
            'device_name' => 'iphone',
        ])
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'token',
                ],
            ]);

        $this->getJson(route('auth.user'), [
            'Authorization' => 'Bearer ' . $response->json('data.token')
        ])
            ->assertSuccessful();
    }

    /** @test **/
    public function user_can_login(): void
    {
        $password = $this->faker->password;

        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => $password,
            'device_name' => 'iphone',
        ])
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'token',
                ],
            ]);

        $this->getJson(route('auth.user'), [
            'Authorization' => 'Bearer ' . $response->json('data.token')
        ])
            ->assertSuccessful();
    }
}
