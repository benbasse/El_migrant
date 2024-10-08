<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "nom" => "Admin",
            "prenom" => "Admin",
            "adresse" => "123 Rue de l'Admin",
            "paysActuelle" => "Sénégal",
            "villeActuelle" => "Dakar",
            "lieuNaissance" => "Dakar",
            "dateNaissance" => "1980-01-01",
            "situation" => "celibatire",
            "sexe" => "homme",
            "role" => "admin",
            "email" => "admin@gmail.com",
            "email_verified_at" => now(),  // Optionnel
            "password" => Hash::make("password123"),
        ]);
    }
}
