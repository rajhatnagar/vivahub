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
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('tax_amount', 10, 2)->default(0)->after('amount');
            $table->boolean('has_gst')->default(false)->after('tax_amount');
            $table->string('billing_gst')->nullable()->after('has_gst');
            $table->string('billing_company')->nullable()->after('billing_gst');
            $table->text('billing_address')->nullable()->after('billing_company');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['tax_amount', 'has_gst', 'billing_gst', 'billing_company', 'billing_address']);
        });
    }
};
