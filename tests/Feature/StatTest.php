<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatTest extends TestCase
{
    use DatabaseMigrations;

    /** @test * */
    public function can_get_user_stat(): void
    {
        $this->login();

        $this->getJson(route('stats.my'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'total',
                ],
            ])
            ->assertJson([
                'data' => [
                    'total' => 1
                ]
            ]);

        $this->getJson(route('stats.my'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'total',
                ],
            ])
            ->assertJson([
                'data' => [
                    'total' => 2
                ]
            ]);
    }

    /** @test * */
    public function can_get_all_stat(): void
    {
        $firstUser = $this->login();

        $this->getJson(route('stats.my'))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'total' => 1
                ]
            ]);

        $this->getJson(route('stats.my'))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'total' => 2
                ]
            ]);

        $secondUser = $this->login();

        $this->getJson(route('stats.my'))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'total' => 1
                ]
            ]);

        $this->getJson(route('stats.my'))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'total' => 2
                ]
            ]);

        $this->getJson(route('stats.all'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'total'
                ],
            ])
            ->assertJson([
                'data' => [
                    'total' => 5 // +1 for new request
                ]
            ]);
    }
}
