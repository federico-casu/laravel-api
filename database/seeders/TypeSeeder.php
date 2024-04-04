<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'FrontEnd',
            'BackEnd',
            'Vue3',
            'Laravel10',
            'Ui',
            'FullStack'
        ];

        foreach ($types as $type) {
            $newType = new Type();

            $newType->name = $type;
            $newType->slug = Project::generateRepoName($newType->name);

            $newType->save();
        }
    }
}
