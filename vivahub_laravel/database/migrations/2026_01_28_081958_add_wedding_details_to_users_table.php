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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'groom_name')) {
                $table->string('groom_name')->nullable();
                $table->string('bride_name')->nullable();
                $table->string('partner_name')->nullable(); // Fallback
                $table->string('wedding_role')->nullable(); // groom or bride
                $table->date('wedding_date')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['groom_name', 'bride_name', 'partner_name', 'wedding_role', 'wedding_date']);
        });
    }
};
