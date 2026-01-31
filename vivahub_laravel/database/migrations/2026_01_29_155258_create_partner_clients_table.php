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
        Schema::create('partner_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            // $table->foreign('partner_id')->references('id')->on('partner_details')->onDelete('cascade');
            $table->string('groom_name');
            $table->string('bride_name');
            $table->string('email')->nullable();
            $table->date('wedding_date')->nullable();
            $table->string('city')->nullable();
            $table->enum('status', ['Active', 'Pending', 'Archived'])->default('Active');
            $table->unsignedBigInteger('invitation_id')->nullable(); // Link to actual invite if created
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_clients');
    }
};
