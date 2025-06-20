<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPlatform;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_subscription()
    {
        $this->authenticate();
        Subscription::factory()->count(3)->create();

        $response = $this->getJson('/api/subscription');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'number_members_paying', 'active', 'user_id', 'subscription_platform_id']]]);
    }

    public function test_can_get_subscription_by_id()
    {
        $this->authenticate();
        $subscription = Subscription::factory()->create();

        $response = $this->getJson("/api/subscription/{$subscription->id}");

        $response->assertOk()
            ->assertJsonFragment(['number_members_paying' => $subscription->number_members_paying]);
    }

    public function test_can_create_subscription()
    {
        $this->authenticate();
        $user = User::factory()->create();
        $platform = SubscriptionPlatform::factory()->create();
        $data = [
            'numberMembersPaying' => 2,
            'active' => true,
            'userId' => $user->id,
            'subscriptionPlatformId' => $platform->id,
        ];
        
        $response = $this->postJson('/api/subscription', $data);

        $response->assertCreated()
            ->assertJsonFragment(['number_members_paying' => 2]);
        $this->assertDatabaseHas('subscription', ['number_members_paying' => 2]);
    }

    public function test_can_update_subscription()
    {
        $this->authenticate();
        $subscription = Subscription::factory()->create();
        $platform = SubscriptionPlatform::factory()->create();

        $response = $this->putJson("/api/subscription/{$subscription->id}", [
            'numberMembersPaying' => $subscription->number_members_paying + 1,
            'subscriptionPlatformId' => $platform->id,
        ]);

        $response->assertOk()
            ->assertJsonFragment(['number_members_paying' => $subscription->number_members_paying + 1]);
    }

    public function test_can_delete_subscription()
    {
        $this->authenticate();
        $subscription = Subscription::factory()->create();

        $response = $this->deleteJson("/api/subscription/{$subscription->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('subscription', ['id' => $subscription->id]);
    }
}
