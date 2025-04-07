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
        Schema::create('food_items', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (ID)
            $table->string('name'); // Food item name (e.g., Burger, Pizza)
            $table->string('category'); // Food category (e.g., Fast Food, Italian)
            $table->decimal('price', 8, 2); // Price with 2 decimal places
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};