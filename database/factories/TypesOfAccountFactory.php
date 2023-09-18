<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TypesOfAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypesOfAccount>
 */
class TypesOfAccountFactory extends Factory
{
    protected $model = TypesOfAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name' => Str::random(5),
            'interest_id' => fake()->randomDigit(),

        ];

    }
}
