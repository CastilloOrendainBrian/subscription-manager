<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Catalog\CatCurrency;
use App\Models\Recurrence;
use App\Models\SubscriptionPlatform;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionPlatform>
 */
class SubscriptionPlatformFactory extends Factory
{
    protected $model = SubscriptionPlatform::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'type' => $this->faker->randomElement(['Streaming', 'Software', 'Gaming', 'Other']),
            'members' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'active' => true,
            'cat_currency_id' => CatCurrency::factory(),
            'recurrence_id' => Recurrence::factory(),
        ];
    }
}
