<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PartnerDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TestPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $user = User::firstOrCreate(
                ['email' => 'partner@test.com'],
                [
                    'name' => 'Test Partner',
                    'password' => Hash::make('password'),
                    'role' => 'partner'
                ]
            );

            if (!$user->partnerDetails) {
                $user->partnerDetails()->create([
                    'agency_name' => 'Agency One',
                    'credits' => 10,
                    'phone' => '1234567890',
                    'gst_number' => '22AAAAA0000A1Z5',
                    'currency' => 'INR',
                    'footer_branding' => true,
                    'footer_text' => 'Planned & Managed by Agency One'
                ]);
            } else {
                // Ensure credits and footer text are set for testing
                $user->partnerDetails->update([
                    'credits' => 10,
                    'footer_text' => 'Planned & Managed by Agency One',
                    'footer_branding' => true
                ]);
            }
        });
        
        $this->command->info('Test Partner Seeder Ran Successfully. Login: partner@test.com / password');
    }
}
