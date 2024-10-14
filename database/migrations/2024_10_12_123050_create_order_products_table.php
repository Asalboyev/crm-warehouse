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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity_pack'); // Quantity in Pochka (package)
            $table->integer('quantity_piece');   // Quantity in individual units
            $table->decimal('price_per_ton', 10, 2);  // Price per ton for this order
            $table->decimal('price_per_unit', 10, 2); // Price per unit for this order
            $table->decimal('total_price', 10, 2);    // Total price for this item
            $table->decimal('total_weight', 10, 3);   // Total weight for this item
            $table->integer('times_sold')->default(1); // Track how many times sold
            $table->boolean('is_returned')->default(false); // Track if the product was returned
            $table->foreignId('sold_by_user_id')->nullable()->constrained('users'); // This line should be here

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
