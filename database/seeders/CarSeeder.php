<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\User;
use Faker\Factory as Faker;

class CarSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Haal alle gebruikers op om de auto's aan toe te wijzen
        $users = User::all();

        // Maak 250 auto's aan
        foreach (range(1, 250) as $index) {
            Car::create([
                'license_plate' => strtoupper($faker->bothify('??-###-??')), // Willekeurige kenteken
                'brand' => $faker->company, // Merk van de auto
                'model' => $faker->word, // Model
                'year' => $faker->year, // Bouwjaar
                'price' => $faker->numberBetween(5000, 50000), // Prijs
                'user_id' => $users->random()->id, // Willekeurige gebruiker (aanbieder)
                'photo' => $faker->imageUrl(640, 480, 'cars', true), // Foto URL (je kan dit ook lokaal opslaan als je wil)
            ]);
        }
    }
}
