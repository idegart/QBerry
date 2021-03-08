<?php

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function can_get_all_quotes(): void
    {
        $this->login();

        $this->seed();

        $this->getJson(route('quotes.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data',
                'pagination',
            ])
            ->assertJson([
                'pagination' => [
                    'total' => Quote::query()->count(),
                ]
            ]);
    }

    /** @test **/
    public function can_get_random_quote(): void
    {
        $this->login();

        $quote = Quote::factory()->create();

        $this->getJson(route('quotes.random', [
            'author' => $quote->character->name,
        ]))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'id' => $quote->getKey(),
                ],
            ]);
    }
}
