<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PartnerProfile;

class PartnerTestSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate([
            'email' => 'partner@test.com'
        ], [
            'name' => 'Test Partner',
            'password' => Hash::make('password'),
            'role' => 'partner'
        ]);

        if(!$user->partnerDetails) {
            $user->partnerDetails()->create([
                'agency_name' => 'Test Agency',
                'credits' => 10,
                'status' => 'active'
            ]);
        }
        
        // Create a test coupon
        $user->partnerDetails->coupons()->create([
            'code' => 'TEST' . rand(100,999),
            'discount_type' => '100% OFF',
            'status' => 'active'
        ]);
    }
}
