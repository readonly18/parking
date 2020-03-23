<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 10; $i++)
        {
            DB::table('clients')->insert([
                'name' => $faker->name,
                'surname' => $faker->name,
                'patronymic' => $faker->name,
                'gender' => $faker->randomElement(['female', 'male']),
                'phone' => $faker->unique()->regexify('[0-9]{11}'),
                'address' => $faker->address
            ]);
        }
    }
}
