<?php

declare(strict_types=1);

use App\Models\Activity;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

final class ActivitySeeder extends AbstractSeed
{
    final public function run(): void
    {
        $faker = Factory::create();

        Activity::init()->create([
            'email' => $faker->email(),
            'title' => $faker->text(30),
        ]);
    }
}
