<?php

namespace Tests\Feature\Catalog;

use App\Models\User;
use App\Models\Catalog\CatCurrency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatCurrencyTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_currencies()
    {
        $this->authenticate();
        CatCurrency::factory()->count(3)->create();

        $response = $this->getJson('/api/cat-currency');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'acronym', 'active']]]);
    }

    public function test_can_get_currency_by_id()
    {
        $this->authenticate();
        $currency = CatCurrency::factory()->create();

        $response = $this->getJson("/api/cat-currency/{$currency->id}");

        $response->assertOk()
            ->assertJsonFragment(['name' => $currency->name]);
    }

    public function test_can_create_currency()
    {
        $this->authenticate();
        $data = [
            'name' => 'Peso Mexicano',
            'acronym' => 'MXN',
            'active' => true,
        ];

        $response = $this->postJson('/api/cat-currency', $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'Peso Mexicano']);
        $this->assertDatabaseHas('cat_currency', ['name' => 'Peso Mexicano']);
    }

    public function test_can_update_currency()
    {
        $this->authenticate();
        $currency = CatCurrency::factory()->create();

        $response = $this->putJson("/api/cat-currency/{$currency->id}", [
            'name' => 'United States Dollar',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'United States Dollar']);
    }

    public function test_can_delete_currency()
    {
        $this->authenticate();
        $currency = CatCurrency::factory()->create();

        $response = $this->deleteJson("/api/cat-currency/{$currency->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('cat_currency', ['id' => $currency->id]);
    }
}