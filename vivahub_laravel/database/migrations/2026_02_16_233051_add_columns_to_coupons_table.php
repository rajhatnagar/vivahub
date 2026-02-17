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
        Schema::table('coupons', function (Blueprint $table) {
            if (!Schema::hasColumn('coupons', 'discount_value')) {
                $table->decimal('discount_value', 8, 2)->nullable();
            }
            if (!Schema::hasColumn('coupons', 'max_uses')) {
                $table->integer('max_uses')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            if (Schema::hasColumn('coupons', 'discount_value')) {
                $table->dropColumn('discount_value');
            }
            if (Schema::hasColumn('coupons', 'max_uses')) {
                $table->dropColumn('max_uses');
            }
        });
    }
};
