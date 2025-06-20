<?php

namespace Tests\Feature\Catalog;

use App\Models\User;
use App\Models\Catalog\CatDay;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatDayTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_days()
    {
        $this->authenticate();
        CatDay::factory()->count(3)->create();

        $response = $this->getJson('/api/cat-day');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'active']]]);
    }

    public function test_can_get_day_by_id()
    {
        $this->authenticate();
        $day = CatDay::factory()->create();

        $response = $this->getJson("/api/cat-day/{$day->id}");

        $response->assertOk()
            ->assertJsonFragment(['name' => $day->name]);
    }

    public function test_can_create_day()
    {
        $this->authenticate();
        $data = [
            'name' => 'Monday',
            'active' => true,
        ];

        $response = $this->postJson('/api/cat-day', $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'Monday']);
        $this->assertDatabaseHas('cat_day', ['name' => 'Monday']);
    }

    public function test_can_update_day()
    {
        $this->authenticate();
        $day = CatDay::factory()->create();

        $response = $this->putJson("/api/cat-day/{$day->id}", [
            'name' => 'Sunday',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Sunday']);
    }

    public function test_can_delete_day()
    {
        $this->authenticate();
        $day = CatDay::factory()->create();

        $response = $this->deleteJson("/api/cat-day/{$day->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('cat_day', ['id' => $day->id]);
    }
}
