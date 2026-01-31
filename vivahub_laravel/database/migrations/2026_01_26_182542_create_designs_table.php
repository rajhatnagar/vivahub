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
        if (!Schema::hasTable('designs')) {
            Schema::create('designs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('category', ['invitation', 'board', 'nfc']); // Main Category
                $table->foreignId('design_type_id')->nullable()->constrained('design_types'); // Sub-type (Wedding, Business, etc.)
                $table->string('image_path');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
