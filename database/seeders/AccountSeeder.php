<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use Faker\Generator as Faker;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
            Account::query()->create([

                'balance'=>$faker->randomFloat(),
                'typeOfAccount'=>$faker->randomDigit(),
                'user_id'=>$faker->randomDigit()

            ]);

    }
}
