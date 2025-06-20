<?php

namespace Database\Factories\Catalog;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Catalog\CatDay;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\CatDay>
 */
class CatDayFactory extends Factory
{
    protected $model = CatDay::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->dayOfWeek,
            'active' => true,
        ];
    }
}
