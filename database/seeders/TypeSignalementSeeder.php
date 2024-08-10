<?php

namespace Database\Seeders;

use App\Models\TypeSignalement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSignalementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeSignalement::create([
            "titre" => "Violence Conjugale",
            "description" => "Description de ce signalement"
        ]);
    }
}
