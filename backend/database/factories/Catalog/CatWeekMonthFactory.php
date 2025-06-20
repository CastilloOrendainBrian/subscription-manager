<?php

namespace Database\Factories\Catalog;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Catalog\CatWeekMonth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\CatWeekMonth>
 */
class CatWeekMonthFactory extends Factory
{
    protected $model = CatWeekMonth::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['First', 'Second', 'Third', 'Fourth', 'Last']),
            'active' => true,
        ];
    }
}
