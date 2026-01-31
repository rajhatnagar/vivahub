<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('partner_details', function (Blueprint $table) {
            if (!Schema::hasColumn('partner_details', 'billing_address')) {
                $table->text('billing_address')->nullable();
            }
            if (!Schema::hasColumn('partner_details', 'gst_number')) {
                $table->string('gst_number')->nullable();
            }
            if (!Schema::hasColumn('partner_details', 'currency')) {
                $table->string('currency')->default('INR');
            }
            if (!Schema::hasColumn('partner_details', 'footer_branding')) {
                $table->boolean('footer_branding')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partner_details', function (Blueprint $table) {
            //
        });
    }
};
