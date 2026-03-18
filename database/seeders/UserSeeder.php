<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Maak 150 gebruikers aan
        foreach (range(1, 150) as $index) {
            User::create([
                'name' => $faker->company, // Bedrijf als naam voor de aanbieder
                'email' => $faker->unique()->safeEmail, // Unieke email
                'password' => bcrypt('password'), // Wachtwoord
            ]);
        }
    }
}
