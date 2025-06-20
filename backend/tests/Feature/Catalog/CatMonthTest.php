<?php

namespace Tests\Feature\Catalog;

use App\Models\User;
use App\Models\Catalog\CatMonth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatMonthTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_months()
    {
        $this->authenticate();
        CatMonth::factory()->count(3)->create();

        $response = $this->getJson('/api/cat-month');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'active']]]);
    }

    public function test_can_get_month_by_id()
    {
        $this->authenticate();
        $month = CatMonth::factory()->create();

        $response = $this->getJson("/api/cat-month/{$month->id}");

        $response->assertOk()
            ->assertJsonFragment(['name' => $month->name]);
    }

    public function test_can_create_month()
    {
        $this->authenticate();
        $data = [
            'name' => 'January',
            'active' => true,
        ];

        $response = $this->postJson('/api/cat-month', $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'January']);
        $this->assertDatabaseHas('cat_month', ['name' => 'January']);
    }

    public function test_can_update_month()
    {
        $this->authenticate();
        $month = CatMonth::factory()->create();

        $response = $this->putJson("/api/cat-month/{$month->id}", [
            'name' => 'February',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'February']);
    }

    public function test_can_delete_month()
    {
        $this->authenticate();
        $month = CatMonth::factory()->create();

        $response = $this->deleteJson("/api/cat-month/{$month->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('cat_month', ['id' => $month->id]);
    }
}
