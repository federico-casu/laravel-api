<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            'HTML5',
            'CSS3',
            'Vite',
            'Vue3',
            'JavaScript',
            'PHP',
            'Laravel'
        ];

        foreach ($technologies as $technology) {
            $newTechnology = new Technology();

            $newTechnology->name = $technology;
            $newTechnology->slug = Project::generateRepoName($newTechnology->name);

            $newTechnology->save();
        }
    }
}
