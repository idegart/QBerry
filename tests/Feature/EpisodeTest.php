<?php

namespace Tests\Feature;

use App\Models\Episode;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EpisodeTest extends TestCase
{
    use DatabaseMigrations;

   /** @test **/
   public function can_get_all_episodes(): void
   {
       $this->login();

       $this->seed();

       $this->getJson(route('episodes.index'))
           ->assertSuccessful()
           ->assertJsonStructure([
               'data',
               'pagination',
           ])
           ->assertJson([
               'pagination' => [
                   'total' => Episode::query()->count(),
               ]
           ]);
   }

   /** @test **/
   public function can_get_one_episode_by_id(): void
   {
       $this->login();

       $episode = Episode::factory()->create();

       $this->getJson(route('episodes.show', $episode))
           ->assertSuccessful()
           ->assertJsonStructure([
               'data' => [
                   'id',
                   'title',
                   'characters',
                   'quotes',
               ]
           ])
           ->assertJson([
               'data' => [
                   'id' => $episode->getKey(),
               ]
           ]);
   }
}
