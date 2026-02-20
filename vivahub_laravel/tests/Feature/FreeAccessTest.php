<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FreeAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_publish_invitation_with_free_access_enabled()
    {
        // 1. Setup User
        $user = User::factory()->create();

        // 2. Enable Free Access
        Setting::updateOrCreate(['key' => 'enable_free_access'], ['value' => '1']);

        // 3. Authenticate
        $this->actingAs($user);

        // 4. Send Publish Request
        $response = $this->postJson(route('builder.save'), [
            'status' => 'published',
            'groom' => 'Test Groom',
            'bride' => 'Test Bride',
            'templateId' => 'wedding-1'
        ]);

        if ($response->status() !== 200) {
            $response->dump();
        }

        // 5. Assert Success
        $response->assertStatus(200)
                 ->assertJson(['success' => true]);
        
        // 6. Verify Expiry Date in DB (Should be ~7 days)
        $invitation = $user->invitations()->first();
        $this->assertNotNull($invitation->expires_at);
        $this->assertTrue($invitation->expires_at->greaterThan(now()->addDays(6)));
        $this->assertTrue($invitation->expires_at->lessThan(now()->addDays(8)));

        // 7. Verify Limit (Try to publish second one)
        $response2 = $this->postJson(route('builder.save'), [
            'status' => 'published',
            'groom' => 'Tests Groom 2',
            'bride' => 'Test Bride 2',
            'templateId' => 'wedding-2'
        ]);
        
        $response2->assertStatus(402)
                  ->assertJsonFragment(['message' => 'Free Access Limit Reached (1 Invitation). Please upgrade to publish more.']);

        // Cleanup
        $user->invitations()->delete();
        $user->delete();
    }

    public function test_user_cannot_publish_invitation_without_payment_when_free_access_disabled()
    {
        // 1. Setup User
        $user = User::factory()->create();

        // 2. Disable Free Access
        Setting::updateOrCreate(['key' => 'enable_free_access'], ['value' => '0']);

        // 3. Authenticate
        $this->actingAs($user);

        // 4. Send Publish Request (Should Fail)
        $response = $this->postJson(route('builder.save'), [
            'status' => 'published',
            'groom' => 'Test Groom',
            'bride' => 'Test Bride',
            'templateId' => 'wedding-1'
        ]);

        // 5. Assert Failure (402 Payment Required)
        $response->assertStatus(402)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Payment or Valid Coupon Required to Publish.'
                 ]);

        // Cleanup
        $user->invitations()->delete();
        $user->delete();
    }
}
