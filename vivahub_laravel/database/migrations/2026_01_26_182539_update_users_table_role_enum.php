<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Using DB statement for ENUM modification is most reliable across versions/drivers for native ENUMs
        // Assuming MySQL/MariaDB based on WAMP path
        // DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'partner') DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user') DEFAULT 'user'");
    }
};
