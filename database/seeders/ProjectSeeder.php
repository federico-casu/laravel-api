<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 10; $i++) {
            $newProject = new Project();

            $newProject->title = $faker->sentence(3);
            $newProject->cover_image = $faker->imageUrl();
            $newProject->repo_name = Project::generateRepoName($newProject->title);
            $newProject->repo_link = $faker->url();
            $newProject->description = $faker->text(500);

            $newProject->save();
        }
    }
}
