<?php

namespace Database\Factories\Catalog;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Catalog\CatCurrency;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CatCurrency>
 */
class CatCurrencyFactory extends Factory
{
    protected $model = CatCurrency::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->currencyCode,
            'acronym' => $this->faker->lexify('???'),
            'active' => true,
        ];
    }
}
