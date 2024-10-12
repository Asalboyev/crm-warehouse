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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity_pochka'); // Quantity in Pochka
            $table->integer('quantity_dona'); // Quantity in individual units
            $table->decimal('price_per_ton', 10, 2); // Price per ton for this order
            $table->decimal('price_per_unit', 10, 2); // Price per unit for this order
            $table->decimal('total_price', 10, 2); // Total price for this item
            $table->decimal('total_weight', 10, 3); // Total weight for this item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
