<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateMissingTables extends Command
{
    protected $signature = 'create:tables';
    protected $description = 'Manually create missing tables for Plans and Transactions';

    public function handle()
    {
        Schema::disableForeignKeyConstraints();

        $this->info('Checking tables...');

        // Plans
        if (!Schema::hasTable('plans')) {
            Schema::create('plans', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->decimal('price', 10, 2);
                $table->string('type')->default('User');
                $table->string('validity'); 
                $table->longText('features')->nullable();
                $table->text('description')->nullable();
                $table->boolean('is_popular')->default(false);
                $table->string('css_class')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
            $this->info('✔ Plans table created.');
        } else {
            $this->info('- Plans table already exists.');
        }

        // Transactions
        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id'); 
                $table->unsignedBigInteger('plan_id')->nullable(); 
                $table->decimal('amount', 10, 2);
                $table->string('gateway');
                $table->string('status');
                $table->string('transaction_id')->nullable()->unique();
                $table->timestamps();
            });
            $this->info('✔ Transactions table created.');
        } else {
             $this->info('- Transactions table already exists.');
        }

        // Settings
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->timestamps();
            });
            $this->info('✔ Settings table created.');
        } else {
             $this->info('- Settings table already exists.');
        }

        // Design Types
        if (!Schema::hasTable('design_types')) {
            Schema::create('design_types', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->timestamps();
            });
            $this->info('✔ Design Types table created.');
        } else {
             $this->info('- Design Types table already exists.');
        }

        // Designs
        if (!Schema::hasTable('designs')) {
            Schema::create('designs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('category', ['invitation', 'board', 'nfc']);
                $table->foreignId('design_type_id')->nullable();
                $table->string('image_path');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
            $this->info('✔ Designs table created.');
        } else {
             $this->info('- Designs table already exists.');
        }

        // Invitations
        if (!Schema::hasTable('invitations')) {
             Schema::create('invitations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->string('slug')->unique();
                $table->string('title');
                $table->json('content')->nullable();
                $table->string('theme')->default('default');
                $table->boolean('is_public')->default(false);
                $table->timestamps();
            });
            $this->info('✔ Invitations table created.');
        } else {
             $this->info('- Invitations table already exists.');
        }

        Schema::enableForeignKeyConstraints();
    }
}
