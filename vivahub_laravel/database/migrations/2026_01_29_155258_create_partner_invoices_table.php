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
        Schema::create('partner_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            // $table->foreign('partner_id')->references('id')->on('partner_details')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('description');
            $table->enum('status', ['Paid', 'Pending', 'Failed'])->default('Pending');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_invoices');
    }
};
