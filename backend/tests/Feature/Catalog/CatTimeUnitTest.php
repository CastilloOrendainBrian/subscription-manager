<?php

namespace Tests\Feature\Catalog;

use App\Models\User;
use App\Models\Catalog\CatTimeUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatTimeUnitTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_time_units()
    {
        $this->authenticate();
        CatTimeUnit::factory()->count(3)->create();

        $response = $this->getJson('/api/cat-time-unit');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'active']]]);
    }

    public function test_can_get_time_unit_by_id()
    {
        $this->authenticate();
        $timeUnit = CatTimeUnit::factory()->create();

        $response = $this->getJson("/api/cat-time-unit/{$timeUnit->id}");

        $response->assertOk()
            ->assertJsonFragment(['name' => $timeUnit->name]);
    }

    public function test_can_create_time_unit()
    {
        $this->authenticate();
        $data = [
            'name' => 'Week',
            'active' => true,
        ];

        $response = $this->postJson('/api/cat-time-unit', $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'Week']);
        $this->assertDatabaseHas('cat_time_unit', ['name' => 'Week']);
    }

    public function test_can_update_time_unit()
    {
        $this->authenticate();
        $timeUnit = CatTimeUnit::factory()->create();

        $response = $this->putJson("/api/cat-time-unit/{$timeUnit->id}", [
            'name' => 'Year',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Year']);
    }

    public function test_can_delete_time_unit()
    {
        $this->authenticate();
        $timeUnit = CatTimeUnit::factory()->create();

        $response = $this->deleteJson("/api/cat-time-unit/{$timeUnit->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('cat_time_unit', ['id' => $timeUnit->id]);
    }
}
