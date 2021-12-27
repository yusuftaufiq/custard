<?php

declare(strict_types=1);

use App\Http\Models\Activity;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

final class ActivitySeeder extends AbstractSeed
{
    public function run(): void
    {
        $faker = Factory::create();

        $id = Activity::init()->create([
            'email' => $faker->email(),
            'title' => $faker->text(30),
        ]);
    }
}
