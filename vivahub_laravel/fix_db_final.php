<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "Starting Database Fix...\n";

// 1. Settings
if (!Schema::hasTable('settings')) {
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('key')->unique();
        $table->text('value')->nullable();
        $table->timestamps();
    });
    echo "✔ Settings table created.\n";
} else {
    echo "- Settings table exists.\n";
}

// 2. Logs
if (!Schema::hasTable('logs')) {
    Schema::create('logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable();
        $table->string('action');
        $table->text('details')->nullable();
        $table->string('ip_address')->nullable();
        $table->timestamps();
    });
    echo "✔ Logs table created.\n";
} else {
    echo "- Logs table exists.\n";
}

// 3. Transactions
if (!Schema::hasTable('transactions')) {
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id'); 
        $table->foreignId('plan_id')->nullable(); 
        $table->decimal('amount', 10, 2);
        $table->string('gateway');
        $table->string('status'); // pending, paid, failed
        $table->string('transaction_id')->nullable();
        $table->timestamps();
    });
    echo "✔ Transactions table created.\n";
} else {
    echo "- Transactions table exists.\n";
}

// 4. Designs
if (!Schema::hasTable('designs')) {
    Schema::create('designs', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->enum('category', ['invitation', 'board', 'nfc']);
        $table->unsignedBigInteger('design_type_id')->nullable();
        $table->string('image_path');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    echo "✔ Designs table created.\n";
} else {
    echo "- Designs table exists.\n";
}

// 5. Design Types
if (!Schema::hasTable('design_types')) {
    Schema::create('design_types', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });
    echo "✔ Design Types table created.\n";
} else {
    echo "- Design Types table exists.\n";
}

echo "Database Fix Complete.\n";
