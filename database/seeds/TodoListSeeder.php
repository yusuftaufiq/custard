<?php

declare(strict_types=1);

use App\Models\Activity;
use App\Models\TodoList;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

final class TodoListSeeder extends AbstractSeed
{
    final public function run(): void
    {
        $faker = Factory::create();

        TodoList::init()->create([
            'activity_group_id' => Activity::init()->random()?->id,
            'title' => $faker->text(30),
            'priority ' => $faker->randomElement(TodoList::init()->priority),
        ]);
    }
}
