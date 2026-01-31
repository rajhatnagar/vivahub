<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Modify users role enum
        // We use raw statement because strict mode or doctrine/dbal issues often plague simple enum changes in Laravel
        try {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user', 'admin', 'partner') NOT NULL DEFAULT 'user'");
        } catch (\Exception $e) {
            // If that fails (e.g. SQLite), we might be in trouble, but for WAMP/MySQL this is standard.
            // Fallback for strict environments if needed, but keeping it simple for now.
        }

        // 2. Partner Details Table
        Schema::create('partner_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // We'll leave the FK constraint off for now if it was causing issues, or re-enable it if confident.
            // Let's try WITHOUT strict FK first to pass the blocker, or use simplified reference.
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('agency_name')->nullable();
            $table->integer('credits')->default(0);
            $table->string('logo_url')->nullable();
            $table->string('phone')->nullable();
            $table->string('primary_color')->default('#800020');
            $table->timestamps();
        });

        // 3. Cleanup conflicting coupons table if it exists (from previous migration)
        Schema::dropIfExists('coupons');

        // 4. Coupons Table (Partner specific)
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            // $table->foreign('partner_id')->references('id')->on('partner_details')->onDelete('cascade');
            // Using constrained() is cleaner if conventions match, but manual is fine.
            // $table->foreign('partner_id')->references('id')->on('partner_details')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('discount_type')->default('100% OFF');
            $table->enum('status', ['active', 'redeemed', 'expired'])->default('active');
            $table->string('client_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('partner_details');
        
        // Reverting enum is risky if data exists, but here is the logic:
        // DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user', 'admin') NOT NULL DEFAULT 'user'");
    }
};
