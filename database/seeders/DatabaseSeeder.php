<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Episode;
use App\Models\Quote;
use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        Episode::factory()
            ->count(30)
            ->create()
            ->each(function (Episode $episode) {
                Character::factory()
                    ->count(random_int(5, 15))
                    ->create()
                    ->each(function (Character $character) use ($episode) {

                        $episode->characters()->attach($character);

                        Quote::factory()
                            ->count(random_int(3, 7))
                            ->create([
                                'episode_id' => $episode->getKey(),
                                'character_id' => $character->getKey(),
                            ]);
                    });
            });
    }
}
