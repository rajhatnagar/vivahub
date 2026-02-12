<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Coupon;
use App\Models\PartnerDetail;
use App\Models\Invitation;
use App\Models\Client;

class PartnerBrandingTest extends TestCase
{
    use RefreshDatabase;

    public function test_partner_branding_appears_when_coupon_used()
    {
        // 1. Create Partner
        $partner = User::factory()->create([
            'role' => 'partner',
            'email' => 'partner@example.com'
        ]);

        // 2. Create Partner Details
        $partnerDetail = PartnerDetail::create([
            'user_id' => $partner->id,
            'agency_name' => 'Elite Weddings',
            'logo_url' => 'https://example.com/logo.png',
            'website' => 'https://eliteweddings.com',
            'phone' => '1234567890'
        ]);

        // 3. Create Coupon linked to Partner
        $coupon = Coupon::create([
            'code' => 'ELITE10',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'partner_id' => $partnerDetail->id, 
            'status' => 'Active', // Use 'Active' (Capitalized) as per migration update
        ]);

        // 4. Create Normal User
        $user = User::factory()->create([
            'role' => 'user',
            'email' => 'couple@example.com'
        ]);

        // 5. Simulate Coupon Usage
        $coupon->update([
            'used_by' => $user->id,
            'used_at' => now(),
            'status' => 'Used' // Use 'Used' as per migration/controller
        ]);

        // 6. Create Invitation (Theme 6 for testing)
        $invitation = Invitation::create([
            'user_id' => $user->id,
            'template_id' => 'theme_6',
            'title' => 'Test Wedding',
            'data' => [
                'bride' => 'Jane',
                'groom' => 'John',
                'date' => '2026-12-12',
                'location' => 'Paris',
                'gallery' => []
            ],
            'status' => 'published'
        ]);

        // 7. Visit Invitation Page
        $response = $this->get(route('invitation.show', $invitation->id));

        // 8. Assert Logic
        $response->assertStatus(200);
        $response->assertViewHas('partnerBranding');
        // $response->assertSee('Elite Weddings'); 
    }

    public function test_default_branding_appears_when_no_partner()
    {
        // 1. Create Normal User
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        // 2. Create Invitation
        $invitation = Invitation::create([
            'user_id' => $user->id,
            'template_id' => 'theme_6',
            'title' => 'Default Wedding',
            'data' => [],
            'status' => 'published'
        ]);

        // 3. Visit Invitation Page
        $response = $this->get(route('invitation.show', $invitation->id));

        // 4. Assert Logic
        $response->assertStatus(200);
        $response->assertViewMissing('partnerBranding'); 
        $response->assertSee('VivaHub'); 
        $response->assertDontSee('Elite Weddings');
    }
}
