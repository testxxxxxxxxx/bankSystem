<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AccountSeeder;
use Database\Seeders\TypeOfAccountSeeder;
use Database\Seeders\InterestSeeder;
use Database\Seeders\ControllerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            UserSeeder::class,
            InterestSeeder::class,
            TypeOfAccountSeeder::class,
            AccountSeeder::class,
            ControllerSeeder::class,

        ]);

    }
}
