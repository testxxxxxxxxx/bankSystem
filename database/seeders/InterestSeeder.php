<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interest;
use Faker\Generator as Faker;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
            Interest::query()->create([

                'value'=>$faker->randomDigit()
    
            ]);

    }
}
