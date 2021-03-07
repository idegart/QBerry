<?php

namespace Tests\Feature;

use App\Models\Character;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CharacterTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function can_get_all_characters(): void
    {
        $this->seed();

        $this->getJson(route('characters.index'))
            ->assertSuccessful()
            ->assertJson([
                'pagination' => [
                    'total' => Character::query()->count(),
                ]
            ]);
    }

    /** @test **/
    public function can_find_character_by_name(): void
    {
        $character = Character::factory()->create();

        $this->getJson(route('characters.index', [
            'name' => strtoupper($character->name),
        ]))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    [
                        'id' => $character->getKey(),
                    ],
                ],
            ]);
    }

    /** @test **/
    public function can_get_random_character(): void
    {
        $character = Character::factory()->create();

        $this->getJson(route('characters.random'))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'id' => $character->getKey(),
                ],
            ]);
    }
}
