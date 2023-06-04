<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypesOfAccount;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TypeOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i=0;$i<10;$i++)
        {

            TypesOfAccount::query()->create([

                'name'=>Str::random(10),
                'interest_id'=>$faker->randomDigit()

            ]);

        }

    }
}
