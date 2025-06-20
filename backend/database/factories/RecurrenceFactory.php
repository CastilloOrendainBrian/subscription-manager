<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Catalog\CatDay;
use App\Models\Catalog\CatMonth;
use App\Models\Catalog\CatTimeUnit;
use App\Models\Catalog\CatWeekMonth;
use App\Models\Recurrence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recurrence>
 */
class RecurrenceFactory extends Factory
{
    protected $model = Recurrence::class;

    public function definition(): array
    {
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->optional()->date(),
            'quantity' => $this->faker->numberBetween(1, 12),
            'cat_time_unit_id' => CatTimeUnit::factory(),
            'cat_day_id' => CatDay::factory(),
            'cat_month_id' => CatMonth::factory(),
            'date_month' => $this->faker->numberBetween(1, 28),
            'cat_week_month_id' => CatWeekMonth::factory(),
            'active' => true,
        ];
    }
}
