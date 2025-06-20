<?php

namespace Tests\Feature\Catalog;

use App\Models\User;
use App\Models\Catalog\CatWeekMonth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatWeekMonthTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_week_months()
    {
        $this->authenticate();
        CatWeekMonth::factory()->count(3)->create();

        $response = $this->getJson('/api/cat-week-month');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'active']]]);
    }

    public function test_can_get_week_month_by_id()
    {
        $this->authenticate();
        $weekMonth = CatWeekMonth::factory()->create();

        $response = $this->getJson("/api/cat-week-month/{$weekMonth->id}");

        $response->assertOk()
            ->assertJsonFragment(['name' => $weekMonth->name]);
    }

    public function test_can_create_week_month()
    {
        $this->authenticate();
        $data = [
            'name' => 'First',
            'active' => true,
        ];

        $response = $this->postJson('/api/cat-week-month', $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'First']);
        $this->assertDatabaseHas('cat_week_month', ['name' => 'First']);
    }

    public function test_can_update_week_month()
    {
        $this->authenticate();
        $weekMonth = CatWeekMonth::factory()->create();

        $response = $this->putJson("/api/cat-week-month/{$weekMonth->id}", [
            'name' => 'Last',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Last']);
    }

    public function test_can_delete_week_month()
    {
        $this->authenticate();
        $weekMonth = CatWeekMonth::factory()->create();

        $response = $this->deleteJson("/api/cat-week-month/{$weekMonth->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('cat_week_month', ['id' => $weekMonth->id]);
    }
}
