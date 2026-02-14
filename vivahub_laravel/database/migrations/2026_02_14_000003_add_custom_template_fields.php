<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('name');
            $table->text('description')->nullable()->after('color');
            $table->string('version', 20)->default('1.0')->after('description');
            $table->boolean('is_custom')->default(false)->after('is_active');
            $table->string('zip_path')->nullable()->after('is_custom');
            $table->string('assets_path')->nullable()->after('zip_path');
        });
    }

    public function down(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description', 'version', 'is_custom', 'zip_path', 'assets_path']);
        });
    }
};
