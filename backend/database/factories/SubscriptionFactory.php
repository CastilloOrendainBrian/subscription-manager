<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Subscription;
use App\Models\SubscriptionPlatform;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number_members_paying' => $this->faker->numberBetween(1, 2),
            'active' => true,
            'user_id' => User::factory(),
            'subscription_platform_id' => SubscriptionPlatform::factory(),
        ];
    }
}
