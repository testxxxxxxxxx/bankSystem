<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Controller;
use App\Services\ControllerService;

class ControllerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ControllerService $controllerService): void
    {
        foreach($controllerService->getControllers() as $controllers)
        {
            Controller::query()->create([

                'name'=>$controllers,

            ]);

        }

    }
    
}
