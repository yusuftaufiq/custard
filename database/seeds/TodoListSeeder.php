<?php

declare(strict_types=1);

use App\Http\Models\Activity;
use App\Http\Models\TodoList;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

final class TodoListSeeder extends AbstractSeed
{
    public function run(): void
    {
        $faker = Factory::create();

        TodoList::init()->create([
            'activity_group_id' => Activity::init()->random()->id,
            'title' => $faker->text(30),
            'priority ' => $faker->randomElement(TodoList::init()->priority),
        ]);
    }
}
