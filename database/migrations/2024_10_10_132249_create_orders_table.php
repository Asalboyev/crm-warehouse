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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients'); // Assuming you have a clients table
            $table->decimal('total_price', 10, 2); // Total price of the order
            $table->decimal('total_weight', 10, 3); // Total weight of the order
            $table->enum('status', ['Yangi', 'Avto keldi', 'completed']); // Order status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
