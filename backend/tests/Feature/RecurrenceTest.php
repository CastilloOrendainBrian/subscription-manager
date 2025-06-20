<?php

namespace Tests\Feature;

use App\Models\Catalog\CatDay;
use App\Models\Catalog\CatMonth;
use App\Models\Catalog\CatTimeUnit;
use App\Models\Catalog\CatWeekMonth;
use App\Models\Recurrence;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecurrenceTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_recurrences()
    {
        $this->authenticate();
        Recurrence::factory()->count(3)->create();

        $response = $this->getJson('/api/recurrence');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'start_date', 'end_date', 'quantity', 'cat_time_unit_id', 'cat_day_id', 'cat_month_id', 'date_month', 'cat_week_month_id', 'active']]]);
    }

    public function test_can_get_recurrence_by_id()
    {
        $this->authenticate();
        $recurrence = Recurrence::factory()->create();

        $response = $this->getJson("/api/recurrence/{$recurrence->id}");

        $response->assertOk()
            ->assertJsonFragment(['quantity' => $recurrence->quantity]);
    }

    public function test_can_create_recurrence()
    {
        $this->authenticate();
        $catTimeUnit = CatTimeUnit::factory()->create();
        $catDay = CatDay::factory()->create();
        $catMonth = CatMonth::factory()->create();
        $catWeekMonth = CatWeekMonth::factory()->create();
        $data = [
            'startDate' => now()->toDateString(),
            'endDate' => now()->addMonth()->toDateString(),
            'quantity' => 2,
            'catTimeUnitId' => $catTimeUnit->id,
            'catDayId' =>  $catDay->id,
            'catMonthId' => $catMonth->id,
            'dateMonth' => 1,
            'catWeekMonthId' => $catWeekMonth->id,
            'active' => true,
        ];

        $response = $this->postJson('/api/recurrence', $data);

        $response->assertCreated()
            ->assertJsonFragment(['quantity' => 2]);
        $this->assertDatabaseHas('recurrence', ['quantity' => 2]);
    }

    public function test_can_update_recurrence()
    {
        $this->authenticate();
        $recurrence = Recurrence::factory()->create();

        $response = $this->putJson("/api/recurrence/{$recurrence->id}", [
            'quantity' => $recurrence->quantity + 1,
        ]);

        $response->assertOk()
            ->assertJsonFragment(['quantity' => $recurrence->quantity + 1]);
    }

    public function test_can_delete_recurrence()
    {
        $this->authenticate();
        $recurrence = Recurrence::factory()->create();

        $response = $this->deleteJson("/api/recurrence/{$recurrence->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('recurrence', ['id' => $recurrence->id]);
    }
}
