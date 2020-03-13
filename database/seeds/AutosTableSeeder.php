<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        $clientsId = DB::table('clients')->pluck('id');
        for($i = 0; $i < 10; $i++)
        {
            DB::table('autos')->insert([
                'brand' => $faker->vehicleBrand,
                'model' => $faker->vehicleModel,
                'color' => $faker->colorName,
                'plate_number' => $faker->unique()->vehicleRegistration,
                'parking_status' => $faker->randomElement([0, 1]),
                'client_id' => $faker->unique()->randomElement($clientsId)
            ]);
        }
    }
}
