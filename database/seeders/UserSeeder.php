<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;
use Faker\Provider\pl_PL\Person;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
            User::query()->create([

                'name'=>$faker->name,
                'lastname'=>$faker->lastName(),
                'personalNumber'=>Person::pesel(),
                'email'=>$faker->unique()->email,
                'password'=>$faker->password()

            ]);
 
    }
}
