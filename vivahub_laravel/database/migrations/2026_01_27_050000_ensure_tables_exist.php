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
        if (!Schema::hasTable('plans')) {
            Schema::create('plans', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->decimal('price', 10, 2);
                $table->string('type')->default('User'); // User, Partner, Offline
                $table->string('validity'); 
                $table->longText('features')->nullable(); // JSON stored as text
                $table->text('description')->nullable();
                $table->boolean('is_popular')->default(false);
                $table->string('css_class')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                // We use bigInteger for plan_id to ensure type match, but allow nullable/no constraint initially to avoid order issues if table missing
                $table->unsignedBigInteger('plan_id')->nullable(); 
                $table->decimal('amount', 10, 2);
                $table->string('gateway'); // Razorpay, PayPal, Stripe
                $table->string('status'); // paid, pending, failed
                $table->string('transaction_id')->nullable()->unique(); // Gateway Transaction ID
                $table->timestamps();
                
                // Add constraint if plans table exists
                if (Schema::hasTable('plans')) {
                    $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Do nothing safely
    }
};
