<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin\Project;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $project = new Project();

            $project->title = $faker->sentence(3);
            $project->description = $faker->text();
            $project->slug = Str::slug($project->title, '-');

            $project->save();
        }
    }
}
