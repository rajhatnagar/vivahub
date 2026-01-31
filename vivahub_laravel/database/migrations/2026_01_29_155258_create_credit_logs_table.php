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
        Schema::create('credit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            // $table->foreign('partner_id')->references('id')->on('partner_details')->onDelete('cascade');
            $table->integer('amount'); // +10 or -1
            $table->string('description');
            $table->enum('type', ['credit', 'debit']);
            $table->string('reference_id')->nullable(); // e.g., INV-001 or COUPON-CODE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_logs');
    }
};
