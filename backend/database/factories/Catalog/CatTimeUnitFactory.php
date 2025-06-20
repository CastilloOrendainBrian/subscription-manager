<?php

namespace Database\Factories\Catalog;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Catalog\CatTimeUnit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\CatTimeUnit>
 */
class CatTimeUnitFactory extends Factory
{
    protected $model = CatTimeUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Day', 'Week', 'Month', 'Year']),
            'active' => true,
        ];
    }
}
