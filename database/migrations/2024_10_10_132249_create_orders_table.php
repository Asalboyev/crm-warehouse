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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // User who created the order
            $table->foreignId('client_id')->constrained('customers')->onDelete('cascade');  // Client ID
            $table->decimal('total_price', 10, 2);  // Total price of the order
            $table->decimal('total_weight', 10, 3);  // Total weight of the order
            $table->string('car_number')->nullable();  // Nullable car number if needed
            $table->text('photos')->nullable();
            $table->boolean('order_status')->default(0); // Set default to 0 or 1 based on your logic
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
