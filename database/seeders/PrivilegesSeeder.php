<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Privileges;

class PrivilegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<8;$i++)
        {
            Privileges::query()->create([

                'controller_id'=>$i,
                'group_id'=>1,

            ]);

        }

    }
    
}
