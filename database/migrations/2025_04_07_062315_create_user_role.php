<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Change the role column to use enum (if not already)
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'customer'])
                  ->default('customer')
                  ->change();
        });
    }

    public function down(): void
    {
        // Revert back to string if needed
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer')->change();
        });
    }
};