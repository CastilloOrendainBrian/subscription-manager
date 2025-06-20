<?php

namespace Tests\Feature;

use App\Models\Catalog\CatCurrency;
use App\Models\Recurrence;
use App\Models\SubscriptionPlatform;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionPlatformTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_subscription_platforms()
    {
        $this->authenticate();
        SubscriptionPlatform::factory()->count(3)->create();

        $response = $this->getJson('/api/subscription-platform');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'type', 'members', 'price', 'active', 'cat_currency_id', 'recurrence_id']]]);
    }

    public function test_can_get_subscription_platform_by_id()
    {
        $this->authenticate();
        $platform = SubscriptionPlatform::factory()->create();

        $response = $this->getJson("/api/subscription-platform/{$platform->id}");

        $response->assertOk()
            ->assertJsonFragment(['name' => $platform->name]);
    }

    public function test_can_create_subscription_platform()
    {
        $this->authenticate();
        $catCurrency = CatCurrency::factory()->create();
        $recurrence = Recurrence::factory()->create();
        $data = [
            'name' => 'Netflix',
            'type' => 'Streaming',
            'members' => 2,
            'price' => 199.99,
            'active' => true,
            'catCurrencyId' => $catCurrency->id,
            'recurrenceId' => $recurrence->id,
        ];

        $response = $this->postJson('/api/subscription-platform', $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'Netflix']);
        $this->assertDatabaseHas('subscription_platform', ['name' => 'Netflix']);
    }

    public function test_can_update_subscription_platform()
    {
        $this->authenticate();
        $platform = SubscriptionPlatform::factory()->create();

        $response = $this->putJson("/api/subscription-platform/{$platform->id}", [
            'name' => 'Disney+',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Disney+']);
    }

    public function test_can_delete_subscription_platform()
    {
        $this->authenticate();
        $platform = SubscriptionPlatform::factory()->create();

        $response = $this->deleteJson("/api/subscription-platform/{$platform->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('subscription_platform', ['id' => $platform->id]);
    }
}
