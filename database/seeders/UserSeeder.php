<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([

            'name'=>'root',
            'lastname'=>'',
            'personalNumber'=>00000000000,
            'email'=>'root@root.com',
            'password'=>'12345678',
            'group_id'=>1,

        ]);

    }
}
