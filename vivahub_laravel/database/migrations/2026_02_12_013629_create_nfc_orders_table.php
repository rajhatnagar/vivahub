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
        Schema::create('nfc_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('invitation_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('partner_id')->nullable()->constrained('partner_details')->nullOnDelete();
            $table->string('name'); // Shipping Name
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('pincode');
            $table->integer('quantity')->default(1);
            $table->string('status')->default('Pending'); // Pending, Processed, Shipped
            $table->string('tracking_number')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfc_orders');
    }
};
