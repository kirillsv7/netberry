<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->insert([
            ['name' => 'PHP'],
            ['name' => 'Javascript'],
            ['name' => 'CSS'],
        ]);

        Task::factory()->count(15)->create();

        foreach (Task::all() as $task) {
            $task->categories()->attach(Category::all()->random(rand(1, 3)));
        }
    }
}
