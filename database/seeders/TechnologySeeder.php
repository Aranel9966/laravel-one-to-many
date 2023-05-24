<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tags = ['PHP', 'HTML', 'Figma', 'MySQL', 'JS', 'CSS', 'Sass', 'Postman', 'VS Code'];

        foreach ($tags as $tag) {
            $newTag = new Technology();

            $newTag->name = $tag;
            $newTag->slug = Str::slug($newTag->name, '-');
            $newTag->color = $faker->hexColor();

            $newTag->save();
        };
    }
}
